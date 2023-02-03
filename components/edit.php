<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$title = $author = $ISBN = $description = $book_image ="";
$title_err = $author_err = $ISBN_err = $description_err = $book_image_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter a title.";     
    } else{
        $title = $input_title;
    }

    // Validate author
    $input_author = trim($_POST["author"]);
    if(empty($input_author)){
        $author_err = "Please enter an author.";
    } elseif(!filter_var($input_author, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $author_err = "Please enter a valid author.";
    } else{
        $author = $input_author;
    }

    // Validate ISBN
    $input_ISBN = trim($_POST["ISBN"]);
    if(empty($input_ISBN)){
        $ISBN_err = "Please enter a ISBN.";     
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

    // Validate book_image
    $input_book_image = trim($_POST["book_image"]);
    if(empty($input_book_image)){
        $book_image_err = "Please enter a book image.";     
    } else{
        $book_image = $input_book_image;
    }
    

    
    // Check input errors before inserting in database
    if(empty($title_err) && empty($author_err) && empty($ISBN_err) && empty($description_err) && empty($book_image_err)){

        // Prepare an update statement
        $sql = "UPDATE books SET title=:title, author=:author, ISBN=:ISBN, description=:description, book_image=:book_image
        WHERE id=:id";



        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":title", $param_title);
            $stmt->bindParam(":author", $param_author);
            $stmt->bindParam(":ISBN", $param_ISBN);
            $stmt->bindParam(":description", $param_description);
            $stmt->bindParam(":book_image", $param_book_image);
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_title = $title;
            $param_author = $author;
            $param_ISBN = $ISBN;
            $param_description = $description;
            $param_book_image = $book_image;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                ?>
                <script>
                    swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Success!',
                    text: 'Your book has been updated.',
                    type: 'success',
                    }).then(function (result) {
                    if (true) {
                        window.location = "index.php";
                    }
                    })
                </script>
            <?php
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM books WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $title = $row["title"];
                    $author = $row["author"];
                    $ISBN = $row["ISBN"];
                    $description = $row["description"];
                    $book_image = $row["book_image"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    echo "More than one book is attempting to be changed";
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
        
        // Close connection
        unset($pdo);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        echo "Oops! Something went wrong. Please try again later.";
    }
}
?>


<div class="w-full flex flex-col items-center">
  <div class="my-6 w-5/6">
    <div class="flex mb-1.5">
      <img src="./assets/images/icon_book.png" alt="Book icon" class="mr-2">
      <p class="font-sans text-blue-600 font-bold text-base">Let's edit this book!</p>
    </div>
    <div class="bg-red-600 py-0.5 rounded-md"></div>
  </div>

  <div class='w-52 mt-3 mb-9 overflow-hidden rounded-r-2xl drop-shadow-lg lg:w-72'>
    <img src="<?php echo $book_image; ?>" alt="<?php echo $title; ?>" class=""> 
  </div>

  <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="POST" class = "mt-2 w-5/6">

      <div class="grid gap-5">

            <input required type="text" name="title" autofocus="autofocus" placeholder="Title" value="<?php echo $title; ?>" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full text-blue-600" title= "Please type the TITLE of the book.">
    
            <input required type="text" name="author" placeholder="Author" value="<?php echo $author; ?>"  class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full text-blue-600" title= "Please type a valid name for the AUTHOR of the book.">
      
            <input required type="text" name="ISBN" placeholder="ISBN" value="<?php echo $ISBN; ?>" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full text-blue-600" pattern="[0-9\-]+" title= "Please type a valid ISBN of the book. Numbers and hyphen only.">
    
            <input required type="text" name="book_image" placeholder="Image URL" value="<?php echo $book_image; ?>"  class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full text-blue-600" pattern="https?://.+" title="Please type the URL of the image, include http://">
        
            <textarea required rows="4" cols="1" type="text" name="description" placeholder="Description" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full text-blue-600" title="Please type a DESCRIPTION of the book."><?php echo $description; ?></textarea> 
      </div>
      <input type="hidden" name="id" value="<?php echo $id; ?>"/>
      <div class="flex gap-5 mt-5 mb-5 justify-between">
        <a href="index.php" class="w-1/2 py-2 bg-red-600 text-white text-sm text-center justify-center rounded-md border border-transparent" >Cancel</a>

        <button type="submit" class="w-1/2 py-2 bg-blue-600 text-white text-sm justify-center rounded-md border border-transparent" >Save</button>
      </div>

  </form>
</div>