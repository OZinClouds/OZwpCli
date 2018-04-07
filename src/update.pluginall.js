
export function updatePluginAll(wpPath, opener){
		swal(
			{
			title: "Update All Plugins",
			text: "Path: " + wpPath ,
			icon: "warning",
			closeOnClickOutside: false,
			dangerMode: true,
  			buttons: {
  					cancel: true,
  					confirm: {
  					  text: "OK, update all plugins",
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
		  				wp:"pluginall",
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
						$(opener).text("all updated!").prop("disabled", true);
						$('[data-btn="btn_plugin_single_update"]').text("updated").prop("disabled", true);
					}
					swal({
						title: "Updated!",
						icon: icon,
						text: wpPath +"\n" + data["output"],
						buttons:false,
						timer:3000
					});
				}).fail(function(){
					swal({
						title: "ERROR!",
						icon: "danger",
						text: "update failed, retry again",
						buttons:{confirm}
					});
				});

			}
		});

	}// end OZsweetPluginAll