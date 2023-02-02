<div class="max-w-2xl pt-4 pb-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
    <div class="grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">

    <?php
    // Include config file
    require_once "config.php";
    
    //https://www.sourcecodester.com/tutorials/php/13884/php-search-filter-using-pdo.html
    // Attempt select query execution
    if(ISSET($_GET['search'])){
        $keyword = $_GET['keyword'];
        $sql = "select * from books where concat(title, author) like '%$keyword%'";
    } else {
        $sql = "SELECT * FROM books";
    }

    if($result = $pdo->query($sql)){
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                echo "<div href='#' >";
                    echo "<div class='aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-r-2xl drop-shadow-lg lg:aspect-w-7 lg:aspect-h-8'>
                        <a href='./displaypage.php?id=". $row['id'] ."' title='View Book' data-toggle='tooltip'>
                            <img src='" . $row['book_image'] . "' alt='" . $row['title'] . "' class=' hover:opacity-75'>
                        </a>
                    </div>";
                    echo "<p class='font-sans text-base font-bold pt-3' >" . $row['title'] . "</p>";
                    echo "<p class='font-sans text-xs text-blue-600 pb-3'>" . $row['author'] . "</p>";
                    echo "<div href='#' class='flex gap-3' >";
                        echo "<a class='w-2/4 bg-orange-300 rounded-md flex items-center justify-center h-10 hover:bg-orange-400' href='./editpage.php?id=". $row['id'] . "' title='Edit Book'> <img src='./assets/images/edit.svg' alt='Edit button' class='w-6'></a>";
                        
                        echo "<a class='w-2/4 bg-red-500 rounded-md flex items-center justify-center h-10 hover:bg-red-600' href='./deletepage.php?id=". $row['id'] . "' title='Delete Book' data-toggle='tooltip'> <img src='./assets/images/delete.svg' alt='Delete button' class='h-6'></a>";
                    echo "</div>";
                echo "</div>";
            }                       

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

    </div>
</div>