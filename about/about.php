<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contacts</a>
      </li>
      <?php
      if(isset($_COOKIE['polzovatel_id'])) {
        $sql = "SELECT * FROM `users` WHERE id=" . $_COOKIE['polzovatel_id'] . " AND Status = 2";
    $result = $conn->query($sql);
     while ($row = mysqli_fetch_assoc($result)) {
          ?>
      <a href="/admin/index.php" class="nav-link">admin</a>
      <?php
   }
 } 
       ?>
    </ul>
    <button id="myInput" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Поиск
    </button>
    <form class="d-flex">
      <?php
      if(isset($_COOKIE['polzovatel_id'])) {
        $sql = "SELECT * FROM `users` WHERE id=" . $_COOKIE['polzovatel_id'];
    $result = $conn->query($sql);
     while ($row = mysqli_fetch_assoc($result)) {
          ?>
      <a href="/vihod.php" class="nav-link"><?php echo $row["login"]; ?></a>
      <?php
   }
 } else {
   ?>
   <a class="nav-link" href="/register.php">Register</a>
  <a class="nav-link" href="/authorization.php">Вход</a>
   <?php
 }
       ?>

      <a href="/basket.php" class="btn btn-outline-success" id="go-basket">
        Корзина - <span>0</span>
      </a>
    </form>
  </div>
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/parts/poisk.php' ?>
