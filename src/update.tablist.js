import {updatePluginAll} from "./update.pluginall.js";
import {updatePluginSingle} from "./update.pluginsingle.js";
import {updateCore} from "./update.core.js";
import {runWPconfigGet} from "./run.wp.config.get.js";

export function updateTabList(el){

		  		
		  		$.ajax({
		  			url: "update.list.php",
		  			type: "post",
		  			data: {
		  				do:"get_all_updates",
		  				wpname:$(el).attr("wp-name"),
		  				wppath:$(el).attr("wp-path") 
		  			},
		  			beforeSend: function(){
		  				$(el).parent().find("i").toggleClass("fa-spin");
		  			},
		  			success: function(data){
		  				$(el).parent().find("i").toggleClass("fa-spin");
		  				$("[data-from='" +  $(el).attr("wp-name")  + "']").html(data);
						
						/*********************** btn_core_update ***********************/
						$("[id^='btn_core_update_']").on("click", function(e){

							updateCore($(e.target).attr("data-path"), this);
						});

						/*********************** btn_plugin_single_update ***********************/
						$('[data-btn="btn_plugin_single_update"]').on('click', function(e){
							var Plugin = $(e.target).attr("data-plugin");
							var wpPath = $(e.target).attr("data-path");
							
							updatePluginSingle(Plugin, wpPath, this );
						});

						/*********************** data-btn="update_pluginall" ***********************/
						$('[data-btn="update_pluginall"]').on("click", function(e){
							var wpPath = $(e.target).attr("data-path");

							updatePluginAll(wpPath, this);
						});


		  			}
		  		});
		  $(".tab-pane.active span").html( runWPconfigGet($(".tab-pane.active span").attr("data-db"), "DB_NAME")  );
		  	
	} //end of updateTabList