<?php 

/*
1. Добавить кнопку для удаления товара
2. Пройтись по всему массиву товара
3. Проверить id товара и удалить 
*/


if(isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST") {
	if(isset($_COOKIE['basket'])) {
		$basket = json_decode($_COOKIE['basket'], true);

		for($i = 0; $i < count($basket['basket']); $i++) {
             if($basket['basket'][$i]['product_id'] == $_POST['id']) {
                unset($basket['basket'][$i]);
                sort($basket['basket']);
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
	 
}

?>