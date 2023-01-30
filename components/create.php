<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$id = $title = $authors = $ISBN = $description = $book_image =  "";
$title_err = $authors_err = $ISBN_err = $description_err = $book_image_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter a title for the book.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid title for the book.";
    } else{
        $title = $input_title;
    }
    
    // Validate authors
    $input_address = trim($_POST["authors"]);
    if(empty($input_authors)){
        $authors_err = "Please enter an address.";     
    } else{
        $authors = $input_authors;
    }
    
    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employees (name, address, salary) VALUES (:name, :address, :salary)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":address", $param_address);
            $stmt->bindParam(":salary", $param_salary);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>

<div class="w-full flex flex-col items-center">
  <div class="my-6 w-5/6">
    <div class="flex mb-1.5">
      <img src="./assets/images/icon_book.png" alt="Book icon" class="mr-2">
      <p class="font-sans text-blue-600 font-bold text-base">Let's create a new book!</p>
    </div>
    <div class="bg-red-600 py-0.5 rounded-md"></div>
  </div>

  <form action="#" method="POST" class = "mt-2 w-5/6">
      <div class="grid gap-5">
          <input type="text" name="title" autofocus="autofocus" require="require" placeholder="Title" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full" >
          <input type="text" name="authors" require="require" placeholder="Author" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full">
          <input type="text" name="isbn" require="require" placeholder="ISBN" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full">
          <input type="text" name="imageUrl"  require="require" placeholder="Image URL"  class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full">
          <textarea rows="4" cols="1" type="text" name="description" require="require" placeholder="Description" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full"></textarea> 
      </div>

      <div class="flex gap-5 mt-5 mb-5 justify-between">
        <a href="index.php" class="w-1/2 py-2 bg-red-600 text-white text-sm text-center justify-center rounded-md border border-transparent" >Cancel</a>
        <button type="submit" class="w-1/2 py-2 bg-blue-600 text-white text-sm justify-center rounded-md border border-transparent" >Save</button>
      </div>
  </form>
</div>

