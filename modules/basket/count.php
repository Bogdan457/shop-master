  <?php 
include $_SERVER["DOCUMENT_ROOT"] ."/configs/db.php";

if(isset($_POST['value'])) {
  $basket = json_decode($_COOKIE['basket'], true);

  for($i = 0; $i < count($basket['basket']); $i++) {
           if($basket['basket'][$i]['product_id'] == $_POST['id']) {
              $basket['basket'][$i]['count'] = $_POST['value'];
           }
  }
  // преобразование масива в json формат
    $jsonProduct = json_encode($basket);

    // Очещаем куки
    setcookie("basket", "", 0, "/");

    // Добавляем куки
    setcookie("basket", $jsonProduct, time() + 60*60, "/");
    echo $jsonProduct;
}


?>
