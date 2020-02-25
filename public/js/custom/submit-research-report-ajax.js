 $(document).ready(function () {
 	$(document).on('click', '.submit-report', function(a){

 		a.preventDefault();

		let id = $(this).data('id');   // it will get id of clicked row

		$("#modaltitle").html("<i class='fas fa-upload fa-fw'></i> Submit Report");
		$(".modal-dialog").addClass("modal-lg");

		$('#crud-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader

		$.ajax({
			url: '/user/card/research-report/create',
			type: 'GET',
			data: 'id='+id,
			dataType: 'html'
		})
		.done(function(data){
			$('#crud-content').html('');
		        $('#crud-content').html(data); // load response
		        $('#modal-loader').hide();      // hide ajax loader
		    })
		.fail(function(){
			$('#crud-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
	});    
 }); 