$(document).ready(function(){
	$('#menu>.menu-item-news>a').click(function(e){
		e.preventDefault();
		$(this).parent().toggleClass('current-menu-item');
		$('#newsform').slideToggle();
	});
	$('#newsform').slideToggle(0);
});