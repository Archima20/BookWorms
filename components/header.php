<head>
<link rel="stylesheet" href="./styles/main.css">
</head>
<body>
<nav class="box-nav">
    <a href="/BookWorms"><img class="img-logo" src="./assets/images/Logobworms.png" alt="Logo"></a>
      <form class="frm-srch box-search" method="GET" action="">
        <input class="inpt-srch input-search" type="search" autocomplete="off" placeholder="Search books by title / author" aria-label="Search" label="Search" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
        <button class="btn-srch" type="submit" name="search">
          <img class="img-search" src="./assets/images/lupa.png" alt="Magnifier glass">
        </button>
      </form>
    </nav>
</body>