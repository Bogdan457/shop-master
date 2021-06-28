<div class="col-6" style="margin: 0 auto;">
<div class="card m-2">
<div class="card-body">
<h5 class="card-title">
  <img class="photo-account" src="data:image/jpeg;base64, <?php echo $img ?>">

  <a href="product.php?id=<?php echo $row['id']; ?>">
     <?php echo $row["title"] ?>
    </a>
</h5>
<p class="card-text"><?php echo substr($row['description'], 0, 250); ?> <a href="product.php?id=<?php echo $row['id']; ?>">Читать дальше...</a></p>
<button class="btn btn-primary" onclick="addToBasket(this)" data-id="<?php echo $row['id'] ?>">
    В корзину
  </button>
   <?php
  if($row['availability'] == 1) {
    ?>
    <p class="card-text" style="color: green;">Есть в наличии</p>
    <?php
  } else {
     ?>
    <p class="card-text" style="color: red;">Нет в наличии</p>
    <?php

  }
 ?>
  <p style="margin-left: 135px; margin-top: -30px;"><?php echo $row["cost"] ?>грн</p>
</div>
</div>
</div><!-- /.col-4 -->
