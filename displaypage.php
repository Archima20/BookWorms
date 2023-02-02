<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM books WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
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
                // URL doesn't contain valid id parameter. Redirect to error page
                echo "There isn't a valid book reference.";
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    //header("location: error.php");
    echo "There is an error.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>View book</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
  <?php include "./components/header.php" ?>
  <div class="flex flex-col place-content-center items-center">
    <div href='#' class="p-5 flex flex-col justify-center items-center  lg:p-10 lg:w-3/4">
        <div class='flex  overflow-hidden rounded-r-2xl drop-shadow-lg my-6 lg:w-72 '>
        <img src='<?php echo $row["book_image"]?>' alt='<?php echo $row["title"] ?>' class='box-content '>
        </div>
        <div class="w-full">
        <p class='font-sans text-lg font-bold pt-3'><?php echo $row["title"]; ?></p>
        <p class='font-sans text-sm text-blue-600 pb-4'><?php echo $row["author"]; ?></p>
        <p class="font-sans text-sm pb-4">ISBN <?php echo $row["ISBN"]; ?></p>
        <p class="font-sans text-sm pb-10"><?php echo $row["description"]; ?></p>
        </div>
        <div class='flex w-full gap-3 pb-10'>
            <a title='Edit Book' class='w-2/4 h-14 bg-orange-300 rounded-md flex items-center justify-center  hover:bg-orange-400' href='editpage.php?id=<?php echo $param_id?>' > <img src='./assets/images/edit.svg' alt='Edit button' class='h-8'></a>

            <a href='deletepage.php?id=<?php echo $param_id ?>' class='w-2/4 h-14 bg-red-500 rounded-md flex items-center justify-center hover:bg-red-600'> <img src='./assets/images/delete.svg' alt='Delete button' class='h-8'></a>
        </div>
    </div>
    </div>
</body>
</html>