<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$ID = $title = $author = $ISBN = $description = $book_image ="";
$ID_err = $title_err = $author_err = $ISBN_err = $description_err = $book_image_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter a title for the book.";     
    } else{
        $title = $input_title;
    }

    // Validate author
    $input_author = trim($_POST["author"]);
    if(empty($input_author)){
        $author_err = "Please enter an author for the book.";
    } elseif(!filter_var($input_author, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $author_err = "Please enter a valid name for the author.";
    } else{
        $author = $input_author;
    }
    
    // Validate ISBN
    $input_ISBN = trim($_POST["ISBN"]);
    if(empty($input_ISBN)){
        $ISBN_err = "Please enter an ISBN.";     
    } else{
        $ISBN = $input_ISBN;
    }
    
    // Validate description
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter a description.";     
    } else{
        $description = $input_description;
    }

    // Validate book image
    $input_book_image = trim($_POST["book_image"]);
    if(empty($input_book_image)){
        $book_image_err = "Please enter an URL for the image.";     
    } else{
        $book_image = $input_book_image;
    }
    
    // Check input errors before inserting in database
    if(empty($title_err) && empty($author_err) && empty($ISBN_err) && empty($description_err) && empty($book_image_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO books (title, author, ISBN, description, book_image) VALUES ('" . $title . "', '" . $author . "', '" . $ISBN . "', '" . $description . "', '" . $book_image . "')";
        ?>
        
        <h1>
        <?php
        echo $sql
        ?>
        </h1>
 
        <?php
        if($stmt = $pdo->prepare($sql)){           
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
          <input type="text" name="author" require="require" placeholder="Author" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full">
          <input type="text" name="ISBN" require="require" placeholder="ISBN" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full">
          <input type="text" name="book_image"  require="require" placeholder="Image URL"  class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full">
          <textarea rows="4" cols="1" type="text" name="description" require="require" placeholder="Description" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full"></textarea> 
      </div>

      <div class="flex gap-5 mt-5 mb-5 justify-between">
        <a href="index.php" class="w-1/2 py-2 bg-red-600 text-white text-sm text-center justify-center rounded-md border border-transparent" >Cancel</a>
        <button type="submit" class="w-1/2 py-2 bg-blue-600 text-white text-sm justify-center rounded-md border border-transparent" >Save</button>
      </div>
  </form>
</div>

