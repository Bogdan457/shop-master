

<?php include "configs/db.php";

include "parts/header.php"; ?>
  <?php
  require_once("configs/db.php");
  if($conn == false){
  	echo "Error!";
  	echo mysqli_connect_errno();
  	exit();
  }
  if (isset($_GET['page'])){
  	$page = $_GET['page'];
  } else {
  	$page = 1;
  }
  $limit = 6;
  $number = ($page * $limit) - $limit;
  $res_count = mysqli_query($conn, "SELECT COUNT(*) FROM `products` ");
  $row = mysqli_fetch_row($res_count);
  $total = $row[0];
  $str_pag = ceil($total / $limit);
  $query = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC LIMIT $number, $limit ");
  ?>
  <html>
  <head>
  <meta charset="utf-8">
  <title>Документ без названия</title>
  </head>
  <style>
  	.art{border: 1px solid #787777;
  	width: 800px;
  	}
  	</style>
  <body>
  <?php
  echo '<div class="row" id="products">';

  if(mysqli_num_rows($query) == 0){
  	echo "There are no records!";
  }	else {
  while($row = mysqli_fetch_assoc($query)){
    $img = base64_encode($row['photo']);
  	include 'parts/product_card.php';

  }
  	}
    echo '</div>';

    for ($i = 1; $i <=$str_pag; $i++){
      echo "<nav aria-label='Page navigation example'>
      <ul class='pagination'>
      <li class='page-item'><a class='page-link' href=index.php?page=".$i.">".$i."</a></li>
      </ul>
      </nav>";

    }
  	?>
  </body>
  </html>


    <?php
      include "parts/footer.php";
    ?>
