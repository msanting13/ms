 $(document).ready(function () {
 	$(document).on('click', '.view-report-details', function(a){

 		a.preventDefault();

		let id = $(this).data('id');   // it will get id of clicked row
		let title = $(this).data("textval");

		$("#modaltitle").html("Researh Title: "+title);
		$(".modal-dialog").addClass("modal-lg");

		$('#crud-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader

		$.ajax({
			url: '/research/report/card/details/'+id,
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