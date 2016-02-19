var total=0;
for(var i=0 ; i<$('.pimage').length;i++){
var x = $('.pimage').get(i);
var val;
$(x).on('click',function(e){
var y = $(e.target).next().children().get(0);
var z = $(e.target).next().children().get(1);
if($(".drink:contains('"+$(y).val()+"')").length !=0){
$(".drink:contains('"+$(y).val()+"')").next()[0].value = parseInt($(".drink:contains('"+$(y).val()+"')").next()[0].value)+1;
 val = parseInt($(".drink:contains('"+$(y).val()+"')").next()[0].value) * $(z).val();
$(".drink:contains('"+$(y).val()+"')").next().next().text(val + " EGP");
 total += parseInt($(z).val());
 console.log(total);
 //$('#oldTotal').val(val);
$(".drink:contains('"+$(y).val()+"')").next().on('change',function(){
 val = parseInt($(".drink:contains('"+$(y).val()+"')").next()[0].value) * $(z).val();
 if(val>parseInt($('#oldTotal').val())){
 total += parseInt($(z).val());
 console.log(total);
 $('#oldTotal').val(val);
 }else{
total -= parseInt($(z).val());
console.log(total); 
$('#oldTotal').val(val);
 }
$(".drink:contains('"+$(y).val()+"')").next().next().text(val+" EGP");
});
}else{
$('#notes').before("<label class='drink'>"+$(y).val()+"</label class='control-label'><input type='number' id='value' value='1' width='20'/><label class='control-label price'>"+$(z).val()+" EGP</label><input type='hidden' id='oldTotal' value='"+total+"' width='20'/><br>");
val = parseInt($(".drink:contains('"+$(y).val()+"')").next()[0].value) * $(z).val();
 total += parseInt($(z).val());
 console.log(total);
//$('#oldTotal').val(val);

$(".drink:contains('"+$(y).val()+"')").next().on('change',function(){
val = parseInt($(".drink:contains('"+$(y).val()+"')").next()[0].value) * $(z).val();
 //total += parseInt($(z).val());
 //console.log(total);
$(".drink:contains('"+$(y).val()+"')").next().next().text(val+" EGP");
if(val>parseInt($('#oldTotal').val())){
 total += parseInt($(z).val());
 console.log(total);
 $('#oldTotal').val(total);
 }else{
total -= parseInt($(z).val());
console.log(total); 
$('#oldTotal').val(total);
}
$(".drink:contains('"+$(y).val()+"')").next().next().text(val+" EGP");
});
}
});

}





