<!--<?php include "calldb.php" ?>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Bookworms library</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/main.css">
  </head>
<body>
  <?php include "./assets/components/header.php" ?>
  <?php
    // Include config file
    require_once "config.php";
    
    // Attempt select query execution
    $sql = "SELECT * FROM books";
    if($result = $pdo->query($sql)){
        if($result->rowCount() > 0){
            echo '<table class="table table-bordered table-striped">';
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>#</th>";
                        echo "<th>Title</th>";
                        echo "<th>Author</th>";
                        echo "<th>ISBN</th>";
                        echo "<th>Description</th>";
                        echo "<th>Book Image URL</th>";
                        echo "<th>Action</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($row = $result->fetch()){
                    echo "<tr>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . $row['author'] . "</td>";
                        echo "<td>" . $row['ISBN'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['book_image'] . "</td>";
                        echo "<td>";
                        echo "<button class='btn-edit'> <img src='./assets/images/edit.png' alt='Edit button'></button>";
                        echo "<button class='btn-delete'> <img src='./assets/images/delete.png' alt='Delete button'></button>";
                        echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";                            
            echo "</table>";
            // Free result set
            unset($result);
        } else{
            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
        }
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }
    
    // Close connection
    unset($pdo);
  ?>
  <!-- ?php include "./assets/components/books.php" ?> -->
 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>