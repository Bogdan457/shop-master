var btnShowMore = document.querySelector("#show-more");

var siteURL = "http://shop-master.local/";
if(btnShowMore) {
  btnShowMore.onclick = function() {
   var curPageInput = document.querySelector("#cur-page");
   // var str = document.querySelector("#str");
   var ajax = new XMLHttpRequest();
       ajax.open("GET", siteURL + "modules/products/get-more.php?page=" + curPageInput.value, false);
       ajax.send();

    curPageInput.value = +curPageInput.value + 1;
    if(ajax.response == "") {
      btnShowMore.style.display = "none";
    }
    if(curPageInput.value == 4) {
      btnShowMore.style.display = "none";
    }
    var productsBlock = document.querySelector("#products");
    productsBlock.innerHTML = productsBlock.innerHTML + ajax.response;

}
}

// function countBasket(er, id, cost) {
//   alert("ok");
//   console.log(er.value);
//   var ajax = new XMLHttpRequest();
//       ajax.open("POST", siteURL + "/modules/basket/count.php", false);
//       ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//       ajax.send("id=" + id + "&&value=" + er.value);
//   var cos = document.querySelector("#cost" + id);
//   cos.innerText = er.value * cost * "basket";
// //   setInterval(function() {
// // document.querySelector("#cost").innerText = cos;
// // }, 1000)

// }

// Добавить товар в корзину
function addToBasket(btn) {

	/*
       1. Сделать ajax запрос на добавления в карзину
       2. Получить данные об успешном добвлении в карзину
       3. Обновить информацию в корзине
	*/

  var ajax = new XMLHttpRequest();
    ajax.open("POST", siteURL + "/modules/basket/add-basket.php", false);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send('id=' + btn.dataset.id);

    var response = JSON.parse(ajax.response);

  var btnGoBasket = document.querySelector("#go-basket span");
      btnGoBasket.innerText = response.count;

}

// Удаление товара
function deleteProductBasket(obj, id) {
  var ajax = new XMLHttpRequest();
      ajax.open("POST", siteURL + "/modules/basket/delete.php", false);
      ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      ajax.send("id=" + id);

      alert('Вы уверены что хотите удалить товар?');

      // Удалить строку с товаром
      obj.parentNode.parentNode.remove();
}

function statusnov() {
  var ajax = new XMLHttpRequest();
      ajax.open("POST", siteURL + "modules/products/orders.php", false);
      ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      ajax.send("id=" + id + "&value=" + er.value);
  var cos = document.querySelector("#cost" + id);
  cos.innerText = er.value * cost;
}

function countBasket(e, id) {
  var ajax = new XMLHttpRequest();
      ajax.open("POST", siteURL + "/modules/basket/count.php", false);
      ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      ajax.send("id=" + id + "&value=" + e.value);
      console.dir(ajax);
      var areerespuse = JSON.parse(ajax.response);
      console.dir(areerespuse);
      for($i = 0; $i < areerespuse.basket.length; $i++) {
        if ( areerespuse.basket[$i]['product_id'] == id) {
        var totalcost = document.getElementById("totalcost#" + id);
        var cost = document.getElementById("cost#" + id);
           totalcost.innerText = cost.innerText * areerespuse.basket[$i]['count'];
           console.dir(totalcost.innerText);
    }
  }

for($i = 0; $i < areerespuse.basket.length; $i++) {
      if ( areerespuse.basket[$i]['product_id'] == id) {
      var theTotal = document.getElementById("the-total#" + id);
      // theTotal.concat(theTotal.innerText = cost.innerText * areerespuse.basket[$i]['count']);
         eval(theTotal.innerText = cost.innerText * areerespuse.basket[$i]['count']);
  }
}

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

  var input2 = document.querySelectorAll("input[id='dva2']:checked")
    document.getElementById("total4").value =
    (input2.length * (input2.length + 99 + rowSumm));

    var input = document.querySelectorAll("input[id='dva']:checked")
    document.getElementById("total5").value =
    (input.length * (input.length + 49 + rowSumm));

}

var photo = document.querySelector('.photo-product');
var photoOpen = document.querySelector('.popup');
var overlay = document.querySelector('.overlay');
    photo.onclick = function(){
      photoOpen.style.display = 'block';
      overlay.style.display= 'block';
    }
var photoClose = document.querySelector('.photo-product-open');
    photoClose.onclick = function(){
      photoOpen.style.display = 'none';
      overlay.style.display= 'none';
    }
    overlay.onclick = function(){
      photoOpen.style.display = 'none';
      overlay.style.display= 'none';
    }

    var myModal = document.getElementById('exampleModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})
