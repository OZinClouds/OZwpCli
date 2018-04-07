import {runBash} from "./run.bash.js";

import "tablesorter/dist/js/jquery.tablesorter.js";
import "tablesorter/dist/css/theme.bootstrap_4.min.css";

/*********************** dblclick to reveal in finder // editwp.php ***********************/
$(document).on("dblclick","#table-dbBackups",function(e){
	var filename=$(e.target).closest("tr").find("td:eq(1)").text().trim();
	var file=$(e.target).closest("tr").attr("data-file");
	var wp=$(e.target).closest("tr").attr("data-wp");
	var siteurl=$(e.target).closest("tr").attr("data-siteurl");

	var i=$(e.target).closest("td").index();

	if(i===1){
		runBash("open -R "+file).done(function(status, out){
			if(status!==0){
				swal("oops",out,"error");
			}
		});
	} else if(i==2){
		window.open("editwp.php?wp="+wp)
	}

});

/*********************** delete file ***********************/
$(document).on("click","[name^=btn-del-]", function(e){
	var filename=$(e.target).closest("tr").find("td:eq(1)").text().trim();
	var file=$(e.target).closest("tr").attr("data-file");
	var wp=$(e.target).closest("tr").attr("data-wp");

	swal({
		title: "delete file?",
		text: filename,
		icon: "warning",
		dangerMode:true,
		buttons:{
			cancel:true,
			confirm:{
				text:"delete file!"
			}
		}
	}).then((value)=>{
		if(value)	{
			runBash("mv -v '"+file+"' ~/.Trash/").done(function(status,out){
					if(status===0){
						swal("deleted",out,"success").then(()=>{
							window.location.reload();
						});
					} else {
						swal("oops",out,"error");
					}
				});
		}


	});

});












