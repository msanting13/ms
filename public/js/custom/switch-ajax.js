 $(document).ready(function () {
 	$(document).on('change', '.switch', function(a){

 		a.preventDefault();

		let id = $(this).data('id');

		$.ajax({
			url: '/news/'+id+'/status',
			type: 'GET',
			dataType: 'JSON'
		})
		.done(function(response){

			if(response['done'] == true) {
				swal({
					title: "Done "+response['message'],
					icon: "success",
					button: "OK",
				})
			} 
			else {
				alert('Error:'+response['message']);
			}
		})
		.fail(function(){
				swal({
					title: "Something went wrong!",
					icon: "error",
					button: "OK",
				})
		});
	});    
 }); 