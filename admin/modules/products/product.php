<?php
include $_SERVER["DOCUMENT_ROOT"] . "/configs/db.php";
$page = "Orders";
include $_SERVER["DOCUMENT_ROOT"] . "/admin/parts/header.php";
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
   <li class="breadcrumb-item"><a href="/admin/orders.php">Orders</a></li>
    <li class="breadcrumb-item active" aria-current="page">Products</li>
  </ol>
</nav>
<?php
// получаем данные выбранного заказа
$row = mysqli_fetch_assoc($conn->query("SELECT * FROM orders WHERE id=" . $_GET["id"]));
$count = 0;
// преобразуем JSON в массив данных для получения товаров
$basket = json_decode($row["products"], true);
?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">
          Products
        </h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class=" text-primary">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Count</th>
                <th scope="col">Costs</th>
                <th scope="col">availability</th>
                <th scope="col">Сума с доставкой</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // цикл вывода количества товаров из корзины
              for ($i = 0; $i < count($basket["basket"]); $i++) {
                // получаем данные товара из заказа
                $product = mysqli_fetch_assoc($conn->query("SELECT * FROM products WHERE id=" . $basket["basket"][$i]["product_id"]));
              ?>
                  <th scope="row"><?php echo $product["id"] ?></th>
                  <td><?php echo $product["title"] ?></td>
                  <td><?php echo $basket["basket"][$i]["count"] ?></td>
                  <td><?php echo $product["cost"] * $basket["basket"][$i]["count"] ?> </td>
                  <td><?php echo $product["availability"] ?> </td>
                  <?php
                  $row = mysqli_fetch_assoc($conn->query("SELECT * FROM orders WHERE id=" . $_GET["id"])); ?>
                  <?php if($row["np"] == 0) { ?>
                  <td><?php echo $row["up"] ?> </td>
                <?php } else {
                  ?>
                  <td><?php echo $row["np"] ?> </td>

                  <?php
                } ?>

                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include $_SERVER["DOCUMENT_ROOT"] . "/admin/parts/footer.php";
?>
