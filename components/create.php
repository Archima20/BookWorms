
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
        
        if($stmt = $pdo->prepare($sql)){           
            // Attempt to execute the prepared statement
            if($stmt->execute()){
            // Records created successfully. Redirect to landing page
                ?>
                <script>
                    swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Success!',
                    text: 'Your book has been saved.',
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
          <input required type="text" name="title" autofocus="autofocus" placeholder="Title" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full" title= "Please type the TITLE of the book." >

          <input required type="text" name="author" placeholder="Author" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full" title= "Please type a valid name for the AUTHOR of the book. ">
          
          <input required type="text" name="ISBN" placeholder="ISBN" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full" pattern="[0-9\-]+"- title= "Please type a valid ISBN of the book. Numbers and hyphen only.">
          
          <input required type="text" name="book_image" placeholder="Image URL"  class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full" pattern="https?://.+" title="Please type the URL of the image, include http://">
          
          <textarea required rows="4" cols="1" type="text" name="description" placeholder="Description" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans p-2 w-full" title="Please type a DESCRIPTION of the book."></textarea> 
      </div>

      <div class="flex gap-5 mt-5 mb-5 justify-between">
        <a href="index.php" class="w-1/2 py-2 bg-red-600 text-white text-sm text-center justify-center rounded-md border border-transparent" >Cancel</a>
        <button type="submit" class="w-1/2 py-2 bg-blue-600 text-white text-sm justify-center rounded-md border border-transparent" >Save</button>
      </div>
  </form>
</div>

