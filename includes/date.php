<?php
// There's lots of datetime to adapt here...

function dateDMY($originalDate) {
	return date("d/m/Y", strtotime($originalDate));
}

function dateHMDMY($originalDate) {
	return date("d/m/Y H:i", strtotime($originalDate));
}

function dateToDate($firstDate, $secondDate) {
	if (date("Ymd", strtotime($firstDate)) == date("Ymd", strtotime($secondDate))) {
		return "<b>Le</b> ". date("d/m/Y", strtotime($firstDate)) .' <b>de</b> '. date("H:i", strtotime($firstDate)) .' <b>à</b> '. date("H:i", strtotime($secondDate));
	} elseif (is_null($secondDate)) {
		return "<b>Dès</b> ". date("d/m/Y H:i", strtotime($firstDate));
	} else if (date("H:i", strtotime($firstDate)) == "00:00" && date("H:i", strtotime($secondDate)) == "00:00") {
		return "<b>Du</b> ". date("d/m/Y", strtotime($firstDate)) .' <b>au</b> '. date("d/m/Y", strtotime($secondDate));
	} else {
		return "<b>Du</b> ". date("d/m/Y H:i", strtotime($firstDate)) .' <b>au</b> '. date("d/m/Y H:i", strtotime($secondDate));
	}
}
