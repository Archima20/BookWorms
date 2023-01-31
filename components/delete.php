<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    echo $_POST["id"];
    // Include config file
    require_once "config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM books WHERE id = :id";

    echo $sql;

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    } else {
        echo "sql not going";
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: index.php");
        exit();
    } else {
        echo "awaiting response";
    }
}
?>


<h2 >Delete Book</h2>
<form action="" method="post">
    <div >
        <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
        <p>Are you sure you want to delete this book from the database?</p>
        <p>
            <button type="submit">Yes</button>
            <a href="index.php" >No</a>
        </p>
    </div>
</form>
