var inputValue = document.getElementById('value');
var nameLbl = document.getElementById('pLbl');
var priceLbl = document.getElementById('priceLbl');
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
	$('#orderForm').before("<label>"+nameLbl"</label><input type='text' id='value' value='1' width='20'/><button id='plus' onclick='increment()'>+</button><button id='minus' onclick='decrement()'>-</button><label>"+priceLbl+"</label>");

});

