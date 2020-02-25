 $(document).ready(function () {
 	$(document).on('click', '.edit-event', function(a){

 		a.preventDefault();

		let id = $(this).data('id');
		
		$("#modaltitle").html("<i class='fas fa-edit fa-fw'></i> Edit Event");
		
		$('#crud-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader

		$.ajax({
			url: '/manage/events/'+id+'/edit',
			type: 'GET',
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