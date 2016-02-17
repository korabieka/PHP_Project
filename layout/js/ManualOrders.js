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
	$('#orderForm').before("<label>HELLO</label><input type='text' id='value' value='1' width='20'/><button id='plus' onclick='increment()'>+</button><button id='minus' onclick='decrement()'>-</button>");

});

