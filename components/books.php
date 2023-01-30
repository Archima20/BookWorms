
<div class="bg-white">
  <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
    <h2 class="sr-only">Books</h2>
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
                echo "<div href='#' class='group'>";
                    echo "<div class='aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8'>
                    <img src='" . $row['book_image'] . "' alt='" . $row['title'] . "' class='h-full w-full object-cover object-center group-hover:opacity-75'>
                    </div>";
                    echo "<h3 class='mt-4 text-sm text-gray-700'>Title</h3>";
                    echo "<p>" . $row['title'] . "</p>";
                    echo "<p class='mt-1 text-lg font-medium text-gray-900'>Author</p>";

                    echo "<p>" . $row['author'] . "</p>";
                    echo "<h3>ISBN</h3><p>" . $row['ISBN'] . "</p>";
                    echo "<h3>Description</h3><p class = 'description'>" . $row['description'] . "</p>";
                    echo "<button class='btn-edit'> <img src='./assets/images/edit.png' alt='Edit button'></button>";
                    echo "<button class='btn-delete'> <img src='./assets/images/delete.png' alt='Delete button'></button>";
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
</div>
