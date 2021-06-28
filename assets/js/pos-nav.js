var btnShowMore1 = document.querySelector("#st1");
var btnShowMore2 = document.querySelector("#st2");
var btnShowMore3 = document.querySelector("#st3");

var siteURL1 = 'page=1';
var siteURL2 = 'page=2';
var siteURL3 = 'page=3';
var siteURL = 'http://shop-master.local/';

if(btnShowMore1) {
  btnShowMore1.onclick = function() {
   var curPageInput = document.querySelector("#str");
   // var str = document.querySelector("#str");
   var ajax = new XMLHttpRequest();
       ajax.open("GET", 'page=1' + "modules/products/get-more.php?page=" + curPageInput.value, false);
       ajax.send();

    curPageInput.value = +curPageInput.value + 1;
    if(ajax.response == "") {
      btnShowMore1.style.display = "none";
    }
    var productsBlock = document.querySelector("#products");
    productsBlock.innerHTML = productsBlock.innerHTML + ajax.response;

}
}

if(btnShowMore2) {
btnShowMore2.onclick = function() {
   var curPageInput = document.querySelector("#str");
   // var str = document.querySelector("#str");
   var ajax = new XMLHttpRequest();
       ajax.open("GET", 'page=2' + "modules/products/get-more.php?page=" + curPageInput.value, false);
       ajax.send();

    curPageInput.value = +curPageInput.value + 1;
    if(ajax.response == "") {
      btnShowMore2.style.display = "none";
    }
    var productsBlock = document.querySelector("#products");
    productsBlock.innerHTML = productsBlock.innerHTML + ajax.response;

}
}

if(btnShowMore3) {
btnShowMore3.onclick = function() {
   var curPageInput = document.querySelector("#str");
   // var str = document.querySelector("#str");
   var ajax = new XMLHttpRequest();
       ajax.open("GET", 'page=3' + "modules/products/get-more.php?page=" + curPageInput.value, false);
       ajax.send();

    curPageInput.value = +curPageInput.value + 1;
    if(ajax.response == "") {
      btnShowMore3.style.display = "none";
    }
    var productsBlock = document.querySelector("#products");
    productsBlock.innerHTML = productsBlock.innerHTML + ajax.response;

}
}

function addToBasket(btn) {
  console.dir(btn.dataset.id);

var ajax = new XMLHttpRequest();
    ajax.open("POST", siteURL + "/modules/basket/add-basket.php", false);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send('id=' + btn.dataset.id);

    var response = JSON.parse(ajax.response); 

  var btnGoBasket = document.querySelector("#go-basket span");
      btnGoBasket.innerText = response.count;
  }