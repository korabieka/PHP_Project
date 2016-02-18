$(function(){
	var url = "../../controller/deliver_server.php";
	var lastModified = 0;
	var oid;
	$("a[name=ancor]").click(function(e){
		oid = $(this).attr("id");
		$.ajax({
			url:url,
			method:'post',
			data:{
				"oid":oid
			},
			success:function(response){
				
			},
			error:function(ayaad,status,error){
				
			},
			complete:function(ayaad){
				
			},

		});
	});
	

});