<?php
include $_SERVER["DOCUMENT_ROOT"] . "/configs/db.php";
$page = "categories";

include  $_SERVER["DOCUMENT_ROOT"] . "/admin/parts/header.php";

if(isset($_POST['submit'])) {
$sql = "INSERT INTO categories (title) VALUES ('" . $_POST['title'] . "')";
if($conn->query($sql)) {
    header("Location: /admin/categories.php");
} else {
    "ошибка";
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
            <h4 class="card-title">Добавление категории</h4>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Название</label>
                            <textarea name="title" type="text" class="form-control" placeholder="Название"></textarea>
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
