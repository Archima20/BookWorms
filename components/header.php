<nav class="box-nav p-5">
  <div class="flex justify-between items-center">
     <a href="/BookWorms"><img src="./assets/images/Logobworms.png" alt="Logo"></a>
    <a href="/BookWorms"><img src="./assets/images/casita.png" alt="Logo"></a>
  </div>
   
  <form class="flex justify-between items-center rounded-md" method="GET">
    <input class="input-search" type="search" autocomplete="off" placeholder="Search books by title / author" aria-label="Search" label="Search" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
    <button class="btn-srch" type="submit" name="search">
      <img class="img-search" src="./assets/images/lupa.png" alt="Magnifier glass">
    </button>
  </form>
</nav>