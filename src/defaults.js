

$(document).on("dblclick", "table[name=table-defaults]", function(e){
	var title=$(e.target).closest("tr").find("td:eq(0)").text().trim();
	var defVal=$(e.target).closest("tr").find("td:eq(1)").text().trim();
	var conf=$(e.target).closest("tr").attr("data-config");

		swal({
			title:title,
			content:{
				element:"input",
				attributes: {
				      defaultValue: defVal,
				    }

			},
			dangerMode:true,
			button: {
			text: "update!",
			closeModal: false,
			cancel:true
			},
		}).then((value)=>{
			$.ajax({
				url:"settings.defaults.update.php",
				method:"post",
				data:{
					do:"run",
					run:"update",
					config:conf,
					title:title,
					newValue:value
				}
			}).done(
				swal("updated",title,"success")
			);
		});
});