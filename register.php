<?php
include $_SERVER["DOCUMENT_ROOT"] ."/configs/db.php";

if(isset($u_code['u_code'])) {
    $sql = "SELECT * FROM users WHERE confirm_mail=" . $u_code['u_code'];

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
        $sql = "UPDATE `users` SET `verifided` = '1' WHERE `id` = " . $user['id'];

        if($conn->query($sql)) {
            echo "Пользователь верифицирован";
        }
    }
}

if(isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST") {
	$password = md5($_POST['pass']);
    $u_code = RandomString(20);
    // Регистрация
    $sql = "INSERT INTO users(login, password, email, confirm_mail) VALUES ('" . $_POST['username'] . "', '" . $password . "', '" . $_POST['email'] . "', '" . $u_code . "')";

    if($conn->query($sql)) {
        echo "Пользователь зарегистрирован";

        $link = "<a href='/register.php?u_code=" . $u_code . "'>Confirm</a>";

        mail($_POST['email'], 'Register', $link);
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

<?php include 'parts/header2.php'; ?>

    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item">Регистрация</li>
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
  <button type="submit" class="btn btn-primary">Register</button>
</form>

<div class="btn-group" style="margin-left: 423px;">
  <a href="authorization.php" class="btn btn-primary">Авторизация</a>
  <a href="register.php" class="btn btn-primary">Регистрация</a>
</div>


</body>
</html>
