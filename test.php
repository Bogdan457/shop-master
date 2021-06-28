<?php
   include "configs/db.php";
?>

<?php

if(isset($_POST['title'])) {
  $sql = "SELECT * FROM `products` WHERE `title` LIKE '%" . $_POST["title"] . "%'";
   $result = $conn->query($sql);
    $product = mysqli_num_rows($result);
}

?>


<div class="row" id="spisok">
       <ul>
        <?php
				if(isset($_POST['title'])) {
        // $i - счетчик для подчета поьзоватилей
        $i = 0;
          // поко в переменной i хранится значение меньше чем количество пользоватилей
        while($i < $product) {
          // mysqli_fetch_assoc - преобразовать полученые данные поьзоватилей в масив
          $row = mysqli_fetch_assoc($result);
					$img = base64_encode($row['photo']);
          // Если существует запрос с поисковым текстом ИИ поиск текст равен имени пользователя

					include 'parts/product_card_poisk.php';

  // Увеличеваем счетчик
  $i = $i + 1;

}
}


?>

       </ul>
			 </div>


			 <script>
    var form = document.querySelector("#poisk");

    form.onsubmit = function(sobitye) {
        sobitye.preventDefault();
        console.dir(sobitye);
    	var title = form.querySelector("input");


        var dannie = "title=" + title.value;


        var ajax = new XMLHttpRequest();
            ajax.open("POST", form.action, false);
            ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            ajax.send(dannie);

        console.dir(ajax);
        var spisokSoobsheniy = document.querySelector("#spisok");
        spisokSoobsheniy.innerHTML = ajax.response;

    }
    </script>
