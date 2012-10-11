jQuery(document).ready(function($) {

function jwl_simple_tooltip(target_items, name){
	$(target_items).each(function(i){
		var title = $(this).attr('title');
		$("body").append("<div class='"+name+"' id='"+name+"_"+title+"'><p>"+title+"</p></div>");
		var jwl_tooltip = $("#"+name+"_"+title);
		if($(this).attr("title") !== ""){ // checks if there is a title
			$(this).removeAttr("title").mouseover(function() {
			jwl_tooltip.css({opacity:0.9, display:"none"}).show(100);
		})
		.mousedown(function(){
			jwl_tooltip.hide(100);
		})
		.mouseout(function(){
			jwl_tooltip.hide(100);
		})
		.mouseup(function(){
			jwl_tooltip.hide(100);
		})
		.mouseover(function(kmouse){
			jwl_tooltip.css("visibility", "visible");
			var offset = $(this).offset();
			//offset.left -= $(jwl_tooltip).width() / 2;
			offset.top -= $(this).height()+10;
			$(jwl_tooltip).offset(offset);			
		});
	}});
}

	 jwl_simple_tooltip("#icons .draggable img", "tooltip");

	//$( "#catalog" ).accordion();
	$(".draggable").draggable({
		appendTo: ".drop-container",
		connectToSortable: ".drop-container",
		delay: 150,
		/*drag: function (event, ui) {
			$(".ui-sortable-helper").addClass("selected");
			$(".tooltip").hide(0);
		},*/
		helper: "original",
		revert: "invalid",
		revertDuration: 250,
		start: function( event, ui ) {
			$("#tooltip"+"_"+$(this).attr("title")).hide(0);
			$(this).addClass("selected");
			$(".tooltip").hide(0);
		},
		stop: function( event, ui ) {
			$(this).removeClass("selected");
		}
	});
			
	$(".drop-container").droppable({
		stop: function ( event, ui ) {
			$(".selected").removeClass("selected ui-sortable-helper");
			$(".tooltip").hide(0);
		},
		hoverClass: "drop-container-hover",
		tolerance: "touch"
	});
	
	$(".drop-container").sortable({
		appendTo: ".drop-container",
		connectWith: ".drop-container",
		sort: function( event, ui ) {
			$(".tooltip").hide(0);
			$(".ui-sortable-helper").addClass("selected");
		},
		stop: function( event, ui ) {
			$(".selected").removeClass("selected ui-sortable-helper");
			if ( ! ui.item.prop('id')){
				ui.item.prop('id', $('img', ui.item).prop('id'));
				$('img', ui.item).removeAttr('id');
			}
			
			$(this).find(".place-holder").remove(0);
			$(this).sortable('refresh');
			serial = $(this).sortable('serialize');
			
			serial = 'row=' + $(this).parents('div.row').prop('id') + '&' + serial;
			alert( serial );

			$.ajax({
				url: jwl_plugin_url + "sort_menu.php",
				type: "post",
				data: serial,
				error: function(){
					alert("theres an error with AJAX");
				}
			});
		},
		tolerance: "pointer",
		update: function( event, ui ) {
			
		}
	});	
});