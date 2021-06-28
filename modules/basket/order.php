<?php
include  $_SERVER["DOCUMENT_ROOT"] . "/configs/db.php";
include  $_SERVER["DOCUMENT_ROOT"] . "/configs/configs.php";
include  $_SERVER["DOCUMENT_ROOT"] . "/modules/telegram/send-message.php";

/*

1. Проверить есть ли в базе данных пользователь с номером телефона что ввел пользователь
2. Если нет то регистрируем пользователя
3. Добавляем  заказ в базу данных с привязкой к ользователю

*/

if(isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST") {

    $sql = "SELECT * FROM users where phone LIKE" . $_POST['phone'];
    $user_id = 0;
    $result = $conn->query($sql);

    if($result) {
        $user = mysqli_fetch_assoc($result);
        $user_id = $user['id'];
    } else {
    	$sql = "INSERT INTO users(login, phone) VALUES ('" . $_POST['username'] .  "', '" . $_POST['phone'] . "')";


    if($conn->query($sql)) {
    	echo "User add";
    	$user_id = $conn->insert_id;
    } else {
    	echo "error user";
    }

	}

    $sql = "INSERT INTO `orders` (`user_id`, `products`, `address`, `np`, `up`) VALUES ('" . $user_id . "', '" . $_COOKIE['basket'] . "', '" . $_POST['address'] . "', '" . $_POST['np'] . "', '" . $_POST['up'] . "')";
    if($conn->query($sql)) {
        // Очещаем куки
      setcookie("basket", "", 0, "/");
    	echo "Заказ оформлен<br/>
    	<a href='/'>На главную</a>";
        message_to_telegram( "Новый заказ" );
    } else {
    	echo "error order";
    }
 }

?>
