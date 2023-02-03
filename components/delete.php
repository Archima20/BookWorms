<?php
if(isset($_POST["id"]) && !empty($_POST["id"])){
    require_once "config.php";
    
    $sql = "DELETE FROM books WHERE id = :id";

    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":id", $param_id);
        
        $param_id = trim($_POST["id"]);
        
        if($stmt->execute()){
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    } 
     
    unset($stmt); 
    unset($pdo);
} else{

    if(empty(trim($_GET["id"]))){
        echo "Oops! Something is missing!";
    } 
}
?>

<form action="" method="post" class="flex justify-center">
    <div class="bg-orange-300 p-10 m-10 rounded-md ">
        <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
        <p class="font-sans text-lg text-white font-bold text-shadow">Are you sure you want to delete this book from the database?</p>
        <div class="flex gap-4 mt-2">
            <button type="submit" class="bg-red-600  text-white font-sans font-bold mt-4 w-20 h-10 rounded-md flex justify-center items-center hover:bg-red-700">Yes</button>
            <a href="index.php" class="bg-blue-500  text-white font-sans font-bold mt-4 w-20 h-10 rounded-md flex justify-center items-center hover:bg-blue-600" >No</a>
        </div>
    </div>
</form>
