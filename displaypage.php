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
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                $title = $row["title"];
                $author = $row["author"];
                $ISBN = $row["ISBN"];
                $description = $row["description"];
                $book_image = $row["book_image"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
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
    exit();
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
    <div href='#' class='display-box'>
        <div class='aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8'>
        <img src='<?php echo $row["book_image"]?>' alt='<?php echo $row["title"] ?>' class='h-50 w-full object-cover object-center group-hover:opacity-75'>
        </div>
        <h3 class='mt-4 text-sm text-gray-700'>Title</h3>
        <p><?php echo $row["title"]; ?></p>
        <p class='mt-1 text-lg font-medium text-gray-900'>Author</p>

        <p><?php echo $row["author"]; ?></p>
        <h3>ISBN</h3><p><?php echo $row["ISBN"]; ?></p>
        <h3>Description</h3><p><?php echo $row["description"]; ?></p>
        <button class='btn-edit'> <img src='./assets/images/edit.png' alt='Edit button'></button>
        <button class='btn-delete'> <img src='./assets/images/delete.png' alt='Delete button'></button>
    </div>
</body>
</html>