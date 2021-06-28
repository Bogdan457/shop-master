<?php
require_once("configs/db.php");
if($connection == false){
	echo "Error!";
	echo mysqli_connect_errno();
	exit();
}
$page = $_GET['id'];
echo $page;
$query = mysqli_query($conn, "SELECT * FROM products WHERE id='$page' ");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>
<style>
	.art{border: 1px solid #787777;
	width: 800px;

	}
	</style>
<body>
<?php
$article = mysqli_fetch_assoc($query);
	echo '<div class="art">';
	echo '( '.$article['id'].' ) <a href=page.php?id='.$article['id'].'>'.$article['title'].'</a><br>';
	echo $article['description'].'<br>';
	echo '</div>';
?>
</body>
</html>
