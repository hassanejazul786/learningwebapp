$(document).ready(function(){
	$('.deletebtn').on('click',function(){
		$('#delete1').modal('show');
		$tr=$(this).closest('tr');
		var data=$tr.children("td").map(function(){
			return $(this).text();
		}).get();

		$('#del1').val(data[0]);
	});


	$('.deletebtn2').on('click',function(){
		$('#delete2').modal('show');
		$tr=$(this).closest('tr');
		var data=$tr.children("td").map(function(){
			return $(this).text();
		}).get();

		$('#del2').val(data[0]);
	});
});


