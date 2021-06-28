<?php
   include "configs/db.php";

   include "parts/header2.php";

	$sql = "SELECT * FROM products WHERE id=" . $_GET['id'];
	$result = $conn->query($sql);
	$row = mysqli_fetch_assoc($result);
	$cateroryResult = $conn->query( 'SELECT * FROM categories WHERE id=' . $row['category_id'] );
	$category = mysqli_fetch_assoc( $cateroryResult );

  ini_set('display_errors', 0);
  $img = base64_encode($row['photo']);

?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb" id="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item">
    	<a href="cat.php?id=<?php echo $category['id'] ?>">
    		<?php echo $category['title'] ?>

    	</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $row['title']; ?></li>
  </ol>
</nav>



<div class="row">
	 <div class="col-12">
	 	<div class="card" id='card-body'>
	 		<div class="card-body">
        <div class="overlay"></div>
        <div class="popup">
          <img class="photo-product-open" src="data:image/jpeg;base64, <?php echo $img ?>">
        </div>
          <img class="photo-product" src="data:image/jpeg;base64, <?php echo $img ?>">
	<h5 class="ptoduct-card-title">
		   <?php echo $row["title"] ?>
	</h5>
  <p class="card-price">Цена: <?php echo $row['cost'] ?>грн</p>
  <button class="btn btn-primary card-button" onclick="addToBasket(this)" data-id="<?php echo $row['id'] ?>">
      В корзину
    </button>

  <?php
    if($row['availability'] == 1) {
      ?>
      <p class="card-availability">Есть в наличии</p>
      <?php
    } else {
       ?>
      <p class="card-no-availability">Нет в наличии</p>
      <?php

    }
   ?>

   <div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        Описание
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body"><?php echo $row['description'] ?></div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        Доп информация
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
       <?php
          $sql = " SELECT `products`.`id`,`products`.`category_id`,`categories`.`title`,`categories`.`id` FROM `products` JOIN `categories` ON `products`.`category_id` = `categories`.`id` WHERE `products`.`id`=" . $_GET['id'];
      $result = $conn->query($sql);
     	while ($row = mysqli_fetch_assoc($result)) {
            ?>
        <div class="accordion-body"><b style="margin-right: 10px;">Категория:</b><?php echo $row['title'] ?></div>
        <?php
     } ?>

    </div>
  </div>
  <!-- <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        Accordion Item #3
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
    </div>
  </div> -->
</div>
              </div>
           </div>
	 	</div>
	 </div>
   <div class="col-12" style="width: 132%;">

      <div class="row">
      <?php
      $page = $_GET['page'];
$offset = $page * 3;

$sql = "SELECT * FROM products WHERE id != '" . $_GET['id'] . "' LIMIT 3 OFFSET " . $offset;
$result = $conn->query($sql);

while ($row = mysqli_fetch_assoc($result)) {
  $img = base64_encode($row['photo']);
   include $_SERVER["DOCUMENT_ROOT"] ."/parts/product_card.php";
}
?>
  </div>
</div>

  <?php
    include "parts/footer.php";
  ?>
