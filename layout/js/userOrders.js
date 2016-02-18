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

for(var i=0 ; i<$('.pimage').length;i++){
var x = $('.pimage').get(i);
$(x).on('click',function(e){
/*
var nameLbl = document.getElementById('pLbl');
var priceLbl = document.getElementById('priceLbl');
*/var y = $(e.target).next().children().get(0);
var z = $(e.target).next().children().get(1);
$('#orderForm').before("<label>"+$(y).val()+"</label><input type='text' id='value' value='1' width='20'/><button id='plus' onclick='increment()'>+</button><button id='minus' onclick='decrement()'>-</button><label>"+$(z).val()+"</label><br>");

});

}
