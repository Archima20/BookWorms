<nav class="box-nav p-5">
  <div class="flex justify-between items-center mb-4">
     <a href="/BookWorms"><img src="./assets/images/logo.svg" alt="Logo"></a>
    <a href="/BookWorms"><img src="./assets/images/casita.png" alt="Logo"></a>
  </div>
   
  <form class="flex items-center my-2 justify-items-stretch rounded-md bg-white" method="GET">
    <input class="w-full py-2 px-4 rounded-md placeholder:text-blue-400 placeholder:text-sm placeholder:font-bold placeholder:font-sans text-blue-600" type="search" autocomplete="off" placeholder="Search by Title / Author" aria-label="Search" label="Search" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
    <button class="px-4" type="submit" name="search">
      <img class="" src="./assets/images/lupa.png" alt="Magnifier glass">
    </button>
  </form>
</nav>