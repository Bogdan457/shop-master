<?php
/*
1. Вывести блок с корзиной - в шапке сайта - done
2. Сделать таблицу в базе данных для хранения заказов - done
3. Добавление в корзину
     3.1 Сделать клик по кнопке 'добавить в корзину' - done
     3.2 Добавить товар в куки карзины - done
     3.3 Отобразить что товар добавился в корзину
4. Сделать страницу корзины
5. Сделать оформление заказа
*/
?>
<?php
   include "configs/db.php";

   include "parts/header2.php";
?>

<div class="row" id="products1">

	<table class="table table-dark">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Title</th>
	      <th scope="col">Count</th>
	      <th scope="col">Costs</th>
        <th scope="col">totalcost</th>
	      <th scope="col">Options</th>
	    </tr>
	  </thead>
	  <tbody>



	       <?php

             if(isset($_COOKIE['basket'])) {
             	$basket = json_decode($_COOKIE['basket'], true);

         	   for($i = 0; $i < count($basket['basket']); $i++) {
         	   	$sql = "SELECT * FROM products WHERE id=" . $basket['basket'][$i]["product_id"];
         	   	$result = $conn->query($sql);
         	   	$product = mysqli_fetch_assoc($result);
         	   	?>
             		<tr>
				      <th scope="row"><?php echo $product['id'] ?></th>
				      <td id='hint' data-title="<?php echo substr($product['title'], 0, 50); ?>">
              <?php echo substr($product['title'], 0, 5); ?><a>...</a>
                      </td>
				       <td>
                        <input id="count#<?php echo $product['id']?>" onkeyup="countBasket(this, <?php echo $product['id'] ?>)" type="number" name="count" value="<?php echo $basket['basket'][$i]["count"] ?>">
                    </td>

                      <!-- <?php var_dump($product['cost']) ?> -->
                      <td id='cost#<?php echo $product['id'] ?>'>
                        <?php echo $product['cost']; ?>
                      </td>
                      <td id='totalcost#<?php echo $product['id'] ?>'>
                        <?php echo $basket['basket'][$i]["count"] * $product['cost']; ?>
                      </td>


				      <td><button onclick="deleteProductBasket(this, <?php echo $product['id'] ?>)" class="btn btn-danger">Delete</button></td>
				    </tr>
				<?php
             	}
             }
	       ?>

	  </tbody>
	 </div>

     <?php
// определите переменные и задайте пустые значения
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $website = test_input($_POST["website"]);
  $comment = test_input($_POST["comment"]);
  $gender = test_input($_POST["gender"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Оформить заказ</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="/modules/basket/order.php">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Ваше имя</label>
                            <input name="username" type="text" class="form-control" placeholder="Username" required="Введите ваше имя">
                        </div>
                    </div>
                    </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Ваш aдрес</label>
                            <textarea name="address" type="text" class="form-control" placeholder="address" required="Введите ваш адрес"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Ваш телефон</label>
                            <input name="phone" type="number" class="form-control" placeholder="phone" required="Введите ваш телефон"></input>
                        </div>
                    </div>
                </div>

                  <p id="deliv"><b>Выбрать достаку</b></p>
                  <div id='the-total'><input type="radio" name="product" id="dva" onclick="codeAddress()" />
                  укр почта:<input value="0" name="up" id="total5" /></div>

                  <div id='the-total2'><input type="radio" name="product" id="dva2" onclick="codeAddress()" />
                  нова почта:<input value="0" name="np" id="total4" /></div>

                <button style="margin-bottom: 20px;" name="submit" value="1" type="submit" class="btn btn-success btn-fill pull-right">Оформить заказ</button>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>



           <table id="mytab" style="display: none;">
           <tr>
    <?php

             if(isset($_COOKIE['basket'])) {
                $basket = json_decode($_COOKIE['basket'], true);

               for($i = 0; $i < count($basket['basket']); $i++) {
                $sql = "SELECT * FROM products WHERE id=" . $basket['basket'][$i]["product_id"];
                $result = $conn->query($sql);
                $product = mysqli_fetch_assoc($result);
                ?>



                       <td id='the-total#<?php echo $product['id'] ?>'>
                        <?php echo $basket['basket'][$i]["count"] * $product['cost'];?>
                      </td>


                <?php
                }
             }
           ?>
  </tr>
  </table>

<div>
  <div id="formulartekst">
    <div>
        <input style="display: none;" value="0" readonly type="text" id="total" />
        <input style="display: none;" value="0" readonly type="text" id="total" />
    </div>
    <div id="formular"><b>Подытог:</b><span id="total3"><script type="text/javascript">
        function codeAddress() {
  var totalSum = 0;

  var table = document.getElementById("mytab");
  // итерирование по строкам
  for (var i = 0, row; row = table.rows[i]; i++) {
    // обнуляем сумму по строке
    rowSumm = 0;
    // итерирование по столбцам
    for (var j = 0, col; col = row.cells[j]; j++) {
      rowSumm += parseFloat(col.firstChild.nodeValue); // parseFloat(col.innerHTML);
    }

    totalSum += rowSumm;

    // console.log('подитог: ' + rowSumm);
 var p = document.getElementById('total3').innerText = rowSumm;

  }





      var input = document.querySelectorAll("input[id='dva']:checked")
    document.getElementById("total5").value =
    (input.length * (input.length + 49 + rowSumm));

    var input2 = document.querySelectorAll("input[id='dva2']:checked")
    document.getElementById("total4").value =
    (input2.length * (input2.length + 99 + rowSumm));

}

        window.onload = codeAddress;
        </script></span></div>
    <div id="formular">
      <p id="deliv"><b>Тарифы доставки</b></p>
      <p id="deliv2">укр почта: 50грн</p>
      <p id="deliv2">нова почта: 100грн</p>
    </div>


<p></p>

  </div>
</div>



  <?php
    include "parts/footer.php";
