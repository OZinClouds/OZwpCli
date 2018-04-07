export function updateCore(wpPath, opener){

		swal(
			{
			title: "Update Core",
			text: "Path: " + wpPath ,
			icon: "warning",
			closeOnClickOutside: false,
			dangerMode: true,
  			buttons: {
  					cancel: true,
  					confirm: {
  					  text: "OK, update WP core",
  					  value: true,
  					  visible: true,
  					  className: "bg-danger",
  					  closeModal: false
  					}
  				},
			}
		). then( (value) => {
			if(value){

				$.ajax(
				{
					url: "update.run.php",
		  			type: "post",
		  			data: {
		  				do:"run",
		  				wp:"core",
		  				wppath:wpPath
		  			}
				}

				).done(function(datas){
					var data=$.parseJSON(datas);
					if(data["exit_status"]!==0){
						var icon="danger";
						$(opener).text("retry update!!");
					} else {
						var icon="success";
						$(opener).text("updated").prop("disabled", true);
					}
					swal({
						title: "Updated!",
						icon: icon,
						text:  wpPath + "\n  \n" + data["output"],
						buttons:false,
						timer:3000
					});
					
				});

			}
		});

	}// end updateCore