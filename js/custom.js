function popitup(url){
	newwindow = window.open(url, 'ASBF - Popup', 'height=500,width=800');
	if(window.focus){
		newwindow.focus();
	}
	return false;
}
