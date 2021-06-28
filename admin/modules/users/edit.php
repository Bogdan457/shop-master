<?php
include $_SERVER["DOCUMENT_ROOT"] . "/configs/db.php";
$page = "Users";

include  $_SERVER["DOCUMENT_ROOT"] . "/admin/parts/header.php";

if(isset($_POST['submit']) && isset($_GET['id'])) {
    $sql = "UPDATE users SET Status = '" . $_POST['status'] . "' WHERE `users`.`id` ='". $_GET['id'] . "'";
    // UPDATE `products` SET `title` = 'sdsssssssq123', `description` = 'wwwwwwwwwww123' WHERE `products`.`id` = 22;
    if($conn->query($sql)) {
        header("Location: /admin/users.php");
    } else {
        echo $sql;
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
            <h4 class="card-title">Сменить статус пользователя</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Статус</label>
                            <select class="form-control" name="status">
                                <option value="0">Не выбрано</option>
                                <?php

                                   $sql = "SELECT * FROM status";
                                   $result = $conn->query($sql);
                                   while ($row = mysqli_fetch_assoc($result)) {
                                       echo "<option value=" . $row["id"] . ">" . $row['title'] . "</option>";
                                   }
                                ?>

                            </select>
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
