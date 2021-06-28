<?php
include $_SERVER["DOCUMENT_ROOT"] ."/configs/db.php";

// if(
// 	isset($_POST["email"]) && isset($_POST["password"])
//     && $_POST["email"] != "" && $_POST["password"] != ""
// ) {
//
//     $sql = "SELECT * FROM `polzovateli` WHERE `email` LIKE '" . $_POST["email"] . "' AND `password` LIKE '" . $_POST["password"] . "'";
//
//     $result = mysqli_query($connect, $sql);
//     $col_polzovateley = mysqli_num_rows($result);
//
//     if($col_polzovateley == 1) {
//     	$polzovatel = mysqli_fetch_assoc($result);
//     	setcookie("polzovatel_id", $polzovatel["id"], time() + 60 * 60 * 24);
//     	header("Location: /pages/myaccount.php");
//     } else {
//     	echo "<h2>Логин или пароль введены не верно</h2>";
//     }
//
// }

if(isset($_GET["u_code"])) {
    $sql = "SELECT * FROM users WHERE confirm_mail LIKE '" . $_GET["u_code"] . "'";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
        $sql = "UPDATE `users` SET `verifided` = '1' WHERE `id` =" . $user['id'];


        if($conn->query($sql)) {
            echo "Пользователь верифицирован";
        }
    }
}

if(isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST") {
	$password = md5($_POST['pass']);
    $u_code = RandomString(20);
    // Авторизация
    // $sql = "SELECT * FROM users(login, password, email, confirm_mail) LIKE ('" . $_POST['username'] . "', '" . $password . "', '" . $_POST['email'] . "', '$u_code')";

    // if($conn->query($sql)) {
    //     echo "Пользователь найден";

    //     $link = "<a href='http://shopaaa.zzz.com.ua/authorization.php?u_code=$u_code'>Confirm</a>";

    //     mail($_POST['email'], 'Register', $link);
    // }

    // логин
    $sql = "SELECT * FROM users WHERE login='" . $_POST['username'] . "' AND password='" . $password . "'";
    $result = $conn->query($sql);
    $user = mysqli_num_rows($result);

    if($user == 1) {
      $polzovatel = mysqli_fetch_assoc($result);
      setcookie("polzovatel_id", $polzovatel["id"], time() + 60 * 60 * 24);
      if($polzovatel['verifided'] == 1) {
        header("Location: index.php");
      } else {
        echo "Вы не верифицированы";
      }
    } else {
        echo "<a href='/ot.php?id='" . $user['id'] . ">Отправить еще раз</a>";
    }

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

<?php include 'parts/header2.php'; ?>

     <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item">Авторизация</li>
  </ol>
</nav>

    <form method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input name="username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">password</label>
    <input name="pass" type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary">Авторизация</button>
</form>

<div class="btn-group" style="margin-left: 423px;">
  <a href="authorization.php" class="btn btn-primary">Авторизация</a>
  <a href="register.php" class="btn btn-primary">Регистрация</a>
</div>

</body>
</html>
