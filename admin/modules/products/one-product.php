<?php
include $_SERVER["DOCUMENT_ROOT"] . "/configs/db.php";
$page = "products";
include $_SERVER["DOCUMENT_ROOT"] . "/admin/parts/header.php";
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
   <li class="breadcrumb-item"><a href="/admin/orders.php">Orders</a></li>
    <li class="breadcrumb-item active" aria-current="page">Products</li>
  </ol>
</nav>

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
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Category</th>
                <th scope="col">Cost</th>
                <th scope="col">availability</th>
              </tr>
            </thead>
            <tbody>
              <?php
                  $sql =  "SELECT * FROM products WHERE id =" . $_GET['id'];
                  $result = $conn->query($sql);
                  while($row = mysqli_fetch_assoc($result)) {
                      ?>
                  <th scope="row"><?php echo $row["id"] ?></th>
                  <?php
                  $sql = "SELECT * FROM products WHERE id=" . $_GET['id'];
                  $result = $conn->query($sql);
                  while ($i = mysqli_fetch_assoc($result)) {
                    $img = base64_encode($i['photo']);
                   ?><img class="photo-account" src="data:image/jpeg;base64, <?php echo $img ?>"><?php
                }
                ?>
                  <td><?php echo $row["title"] ?></td>
                  <td><?php echo $row["description"]?></td>
                  <td><?php echo $row["category_id"] ?> </td>
                  <td><?php echo $row["cost"] ?> </td>
                  <td><?php echo $row["availability"] ?> </td>
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
