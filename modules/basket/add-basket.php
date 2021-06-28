<?php 
include $_SERVER["DOCUMENT_ROOT"] ."/configs/db.php";

   /*
      1. Получить товар по которому кликнул поьзователь - done
      2. Добавить в мосив товаров - done
      3. Добавить масив в куки - done

      4. Перебрать прошлый масив
          4.1 Преоразовать json с куки в массив
          4.2 Добавить новый элемент в массив
          4.3 Преобразовать массив в правильный json
          4.4 Добавить в куки
   */
      // Проверяем был ли отправлен пост запрос
      if(isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST") {
      $sql = "SELECT * FROM products WHERE id=" . $_POST['id'];

      $result = $conn->query($sql);

      $product = mysqli_fetch_assoc($result);

      // Добавление  в корзину
      if(isset($_COOKIE['basket'])) {// Если в корзине уже что-то есть
         $basket = json_decode($_COOKIE['basket'], true);
  
        /*
          1. Пройтись по всему масиву корзины - done
          2. Проверить есть ли совподения по id 
          3. Если совподение есть: увеличить количество товара
        
        */
          $issetProduct = 0;
          for($i = 0; $i < count($basket["basket"]); $i++) {
              if( $basket["basket"][$i]["product_id"] == $product['id'] ) {
                  $basket["basket"][$i]["count"]++;
                  $issetProduct = 1;

              }
          }

         if($issetProduct != 1) {
            $basket["basket"][] = [
            "product_id" => $product['id'],
            "count" => 1,
          ];
         }

         

         /*
           product_id: 1
           count: 3
          
         */


      } else {// Если корзина пустая
         // $basket = [];
         $basket = [ "basket" => [
          ["product_id" => $product['id'],
          "count" => 1]
        ]
      ];
      }

      // преобразование масива в json формат
      $jsonProduct = json_encode($basket);

      // Очещаем куки
      setcookie("basket", "", 0, "/");

      // Добавляем куки
      setcookie("basket", $jsonProduct, time() + 60*60, "/");

      echo json_encode([
         "count" => count($basket['basket'])
      ]);
     }
?>