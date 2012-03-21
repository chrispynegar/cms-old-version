$(document).ready(function() {
	
	// get height and width of the page
	var window_width = $(window).width();
	var window_height = $(window).height();
	
	// vertical and horizontal centering of modal window(s)
	// we will use each function so if we have more than one window we can centre them all
	$('.modal-window').each(function() {
		
		// get the height and width of the modal
		var modal_height = $(this).outerHeight();
		var modal_width = $(this).outerWidth();
		
		// calculate top and width offset needed for centering
		var top = (window_height-modal_height)/2;
		var left = (window_width-modal_width)/2;
		
		// apply new top and left css values
		$(this).css({'top' : top, 'left' : left});
		
	});
	
	$('.activate-modal').click(function() {
		
		// get the id of the modal window stored in the same name of the activating element
		var modal_id = $(this).attr('name');
		
		// use the function to show it
		show_modal(modal_id);
		
	});
	
	$('.close-modal').click(function() {
		
		// use the function to close it
		close_modal();
		
	});
	
});

// functions

function close_modal() {
	
	// hide the mask
	$('#modal-mask').fadeOut(500);
	
	// hide modal window
	$('.modal-window').fadeOut(500);
	
}

function show_modal(modal_id) {
	
	// set the display to block and opacity to 0 so we can fade to
	$('#modal-mask').css({ 'display' : 'block', opacity : 0 });
	
	// fade in the mask opacity 0.8
	$('#modal-mask').fadeTo(500,0.8);
	
	// show the modal window
	$('#'+modal_id).fadeIn(500);
	
}