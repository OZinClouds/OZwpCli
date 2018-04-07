export function updateEverything(){
$("button[data-name='wp-update-everything'] i").toggleClass('fa-spin');


	swal(
			{
			title: "Update Everything",
			text: "Core and Plugin Updates of all WP installations",
			icon: "warning",
			closeOnClickOutside: false,
			dangerMode: true,
  			buttons: {
  					cancel: true,
  					confirm: {
  					  text: "OK, update everything",
  					  value: true,
  					  visible: true,
  					  className: "bg-danger",
  					  closeModal: false
  					}
  				},
			}
		). then( (value) => {
			if(value){
	
			$.ajax({
				url: "../inc/update.run.php",
				type: "post",
				data: {
					do: "run",
					wp: "everything"
					},
			success: function(datas){
				
				$("button[data-name='wp-update-everything']")
					.html("..all updated")
					.removeClass("btn-warning").addClass("btn-success");
				
				swal({
					title: "Updated!",
					icon: "success",
					text: "everything",
					buttons:false,
					timer:3000
				});

				$("#tbl-everything").removeClass("d-none");
				$("button[data-name='wp-update-everything'] i").toggleClass('fa-spin');

				},//end success function
			error: function(xhr, status, err){

				swal({
					title: "ERROR!",
					icon: "danger",
					text: "update failed, retry again",
					buttons:{confirm}
				});


				}// end error function	

			});	
			} else {
				$("button[data-name='wp-update-everything'] i").toggleClass('fa-spin');
			}
		});


}// end updateEverything
