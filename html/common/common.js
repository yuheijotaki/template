


function device() {
	if ( _ua.Mobile ) {
		alert('mobile');
	} else if ( _ua.Tablet ) {
		alert('tablet');
		document.getElementById('viewport').setAttribute('content','width=1200');
	} else {
		alert('others');
	}
}



function hoge() {
}





$(function(){
	hoge();
}); // ready





$(window).on('load', function(){
}); // load





$(window).on('resize', function(){
}); // resize





$(window).scroll(function(){
}); // scroll





$(window).on('load resize', function(){
}); // load resize