<?php
include $_SERVER["DOCUMENT_ROOT"] . "/configs/db.php";
$page = "products";

include  $_SERVER["DOCUMENT_ROOT"] . "/admin/parts/header.php";

if(isset($_POST['submit'])) {
  $img_type = substr($_FILES['img_upload']['type'], 0, 5);
$img_size = 2*1024*1024;
if(!empty($_FILES['img_upload']['tmp_name']) and $img_type === 'image' and $_FILES['img_upload']['size'] <= $img_size){
$photo = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
$sql = ("INSERT INTO products (title, description,  category_id, cost, availability, photo) VALUES ('" . $_POST['title'] . "', '" . $_POST['description'] . "', '" . $_POST['cet_id'] . "', '" . $_POST['Cost'] . "', '" . $_POST['availability'] . "','$photo')");
if($conn->query($sql)) {
    header("Location: /admin/products.php");
} else {
    "ошибка";
}
}
}
?>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
    <li class="breadcrumb-item">Добавить</li>
  </ol>
</nav>

<div class="row">
<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Добавление продукта</h4>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control" placeholder="Title">
                        </div>
                    </div>
                    </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" type="text" class="form-control" placeholder="Description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Cost</label>
                            <textarea name="Cost" type="text" class="form-control" placeholder="Cost"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>availability</label>
                            <select class="form-control" name="availability">
                                <option value="0">Не выбрано</option>
                                <?php

                                   $sql = "SELECT * FROM availability";
                                   $result = $conn->query($sql);
                                   while ($row = mysqli_fetch_assoc($result)) {
                                     echo "<option value=" . $row["id"] . ">" . $row['title'] . "</option>";
                                   }
                                ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="cet_id">
                                <option value="0">Не выбрано</option>
                                <?php

                                   $sql = "SELECT * FROM categories";
                                   $result = $conn->query($sql);
                                   while ($row = mysqli_fetch_assoc($result)) {
                                       echo "<option value=" . $row["id"] . ">" . $row['title'] . "</option>";
                                   }
                                ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Загрузить картику</label>
                            <input type="file" name="img_upload">
                        </div>
                    </div>
                </div>
                <button name="submit" value="1" type="submit" class="btn btn-success btn-fill pull-right">SAVE</button>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
</div>
