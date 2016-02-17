var inputValue = document.getElementById('value');
function increment(){
value.value++;
}
function decrement(){
if(value.value == 1){
value.value = 1
}else{
value.value--;
}
}

$('#drinksTbl img').on('click',function(){
/*
var nameLbl = document.getElementById('pLbl');
var priceLbl = document.getElementById('priceLbl');
*/
$('#orderForm').before("<label>"+$('[id ^= "pLbl"]').val()+"</label><input type='text' id='value' value='1' width='20'/><button id='plus' onclick='increment()'>+</button><button id='minus' onclick='decrement()'>-</button><label>"+$('[id ^= "priceLbl"]').val()+"</label>");

});

