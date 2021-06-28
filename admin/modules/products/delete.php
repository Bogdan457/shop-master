<?php 
include $_SERVER["DOCUMENT_ROOT"] . "/configs/db.php";
$page = "products";

include  $_SERVER["DOCUMENT_ROOT"] . "/admin/parts/header.php";

if(isset($_POST['submit']) && isset($_GET['id'])) { 
    $sql = "DELETE FROM products WHERE `products`.`id` ='". $_GET['id'] . "'";
    // UPDATE `products` SET `title` = 'sdsssssssq123', `description` = 'wwwwwwwwwww123' WHERE `products`.`id` = 22;
    if($conn->query($sql)) {
        header("Location: /admin/products.php");
    } else {
       echo "ошибка";
    }
}
?>

<div class="row">
<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Удаление продукта</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <label>Вы действительно хотите удалить продукт?</label>
                        </div>
                    </div>
                </div>
                <button name="submit" value="1" type="submit" class="btn btn-success btn-fill pull-right">Удалить</button>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
</div>