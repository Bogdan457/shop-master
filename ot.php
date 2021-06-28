<?php 
include $_SERVER["DOCUMENT_ROOT"] ."/configs/db.php";

if(isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST") {
    $u_code = RandomString(20);
    // Регистрация
    $sql = "INSERT INTO users(email) VALUES ('" . $_POST['email'] . "')";

    if($conn->query($sql)) {
        echo "Письмо отправлено";

        $link = "<a href='/authorization.php?u_code=" . $u_code . "'>Confirm</a>";

        mail($_POST['email'], 'Register', $link);

        $sql = "UPDATE `users` SET `confirm_mail` = " . $u_code . " WHERE `id`=" . $_GET['id'];
        $result = $conn->query($sql);
    }

    // логин
    // $sql = "SELECT * FROM users WHERE login='" . $_POST['username'] . "' AND password='$password'";
    // $result = $conn->query($sql);

    // if($result->num_rows > 0) {
    //     echo "Пользователь найден";
    // } else {
    //     echo "Error";
    // }

}

    function RandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randstring;
    }

/*

1. Сделать форму регистрации - done
2. Сделать отправку формы - done
3. Сделать отправку письма со ссылкой на подтверждение регистрации
4. Сделать страницу с подтверждением регистрации

*/

?>

<!DOCTYPE html>
<html>
<head>
	<title>Повторная отправка письма</title>
</head>
<body>

    <form method="POST">
    <p>Email<br/>
        <input type="text" name="email">    
        <button name="otpravit" onclick="ot(this)">Отправить</button>
    </p>
    </form>

</body>
</html>