<?php
include $_SERVER["DOCUMENT_ROOT"] . "/configs/db.php";
$page = "Orders";
include $_SERVER["DOCUMENT_ROOT"] . "/admin/parts/header.php";

//создаём запрос на вывод данных выбранного продукта в таблицу редактирования
$sql = "SELECT * FROM orders WHERE id=" . $_GET["id"];
//посылаем запрос
$result = $conn->query($sql);
//возвращаем выбранный товар из БД в виде массива элементов
$row = mysqli_fetch_assoc($result);

//если есть елик по кнопке
if(isset($_POST['submit'])) {
    //запрос в БД на редактирование товара
    $sql = "UPDATE orders SET
                status= '" . $_POST["status"] . "'
                    WHERE orders.id = '" . $_POST["id"] . "'";


        //если выполнился запрос то...
        if($conn->query($sql)) {
              //перход на главную страницу админ-панели
              header("Location: /admin/orders.php");

        } else {
          //в ином случае выводим Ошибку
          echo "Error!";
        }
  }
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
    <li class="breadcrumb-item"><a href="/admin/orders.php">Orders</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
</nav>


<div class="row">
  <div class="col-md-12">
      <div class="card">
        <div class="card-header-primary">
          <h4 class="card-title">status</h4>
        </div>
        <div class="card-body">
            <form method="POST">
              <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">Status</label>
                        <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
                        <input name="status" value="<?php echo $row["status"] ?>" type="text" class="form-control" >
                      </div>
                    </div>
                 </div>

              <button name="submit" value="1" type="submit" class="btn btn-success pull-right">SAVE</button>
              <div class="clearfix"></div>
            </form>
        </div>
    </div>
  </div>
</div>
<?php
include $_SERVER["DOCUMENT_ROOT"] . "/admin/parts/footer.php";
?>
