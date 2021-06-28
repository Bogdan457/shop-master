<?php
include $_SERVER["DOCUMENT_ROOT"] . "/configs/db.php";
$page = "categories";

include  $_SERVER["DOCUMENT_ROOT"] . "/admin/parts/header.php";

if(isset($_POST['submit']) && isset($_GET['id'])) {
    $sql = "UPDATE categories SET title = '" . $_POST['title'] . "' WHERE `categories`.`id` ='". $_GET['id'] . "'";
    // UPDATE `products` SET `title` = 'sdsssssssq123', `description` = 'wwwwwwwwwww123' WHERE `products`.`id` = 22;
    if($conn->query($sql)) {
        header("Location: /admin/categories.php");
    } else {
       echo "ошибка";
    }
}
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
    <li class="breadcrumb-item" placeholder="Редактирование"></li>
  </ol>
</nav>

<div class="row">
<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Редактирование категории</h4>
        </div>
        <div class="card-body">
            <form method="POST">
              <?php
                  $sql =  "SELECT * FROM categories WHERE id=" . $_GET['id'];
                  $result = $conn->query($sql);
                  while($row = mysqli_fetch_assoc($result)) {
                      ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" value="<?php echo $row['title']?>" class="form-control" placeholder="Title">
                        </div>
                    </div>
                </div>
              <?php } ?>
                <button name="submit" value="1" type="submit" class="btn btn-success btn-fill pull-right">SAVE</button>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
</div>
