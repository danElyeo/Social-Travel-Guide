// JavaScript Document
$(function() {
    // there's the gallery and the trash
    var activities_pickup= $( "#activities_pickup" ),
      schedule_drop = $( "#schedule_drop" );
	  
	// let the activity items be draggable
    $( "li", activities_pickup ).draggable({
      cancel: "a.ui-icon", // clicking an icon won't initiate dragging
      revert: "invalid", // when not dropped, the item will revert back to its initial position
      containment: "document",
      helper: "clone",
      cursor: "move"
    });
	
	// let the schedule be droppable, accepting the activity items
    schedule_drop.droppable({
      accept: "#activities_pickup li",
      activeClass: "ui-state-highlight",
      drop: function( event, ui ) {
		  //alert(ui.draggable);
        addActivityToSchedule( ui.draggable );
      }
    });
	
	// let the activity_pickup be droppable as well, accepting items from the schedule
    activities_pickup.droppable({
      accept: "#schedule_drop li",
      //activeClass: "custom-state-active",
	  activeClass: "ui-state-highlight",
      drop: function( event, ui ) {
        //recycleImage( ui.draggable );
		removeActivityFromSchedule(ui.draggable);
      }
    });
});

function addActivityToSchedule(dropped_item) {
	dropped_item.fadeOut(function() 
	{
		var list = $('#schedule_drop' );
		
		// Add the item into the ul in schedule drop
		dropped_item.appendTo(list).fadeIn();
	});
}

function removeActivityFromSchedule(dropped_item) {
	dropped_item.fadeOut(function()
	{
		var list = $("#activities_pickup");
		
		// Add the item into ul in activities_pickup
		dropped_item.appendTo(list).fadeIn();
	});
}