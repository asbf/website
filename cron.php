<?php
date_default_timezone_set("Europe/Paris"); // Google needs to have the timezone set
require 'includes/date.php';
require 'includes/linkify.php';
require 'includes/logins.php';

// Needed to work with the calendar API
require 'includes/google-api-php-client/src/Google/autoload.php';

$client = new Google_Client();
$client->setApplicationName("ASBF-cal"); // The name for the developper console
$client->setDeveloperKey($gcalAPI); // API Key, please see logins.php

$cal = new Google_Service_Calendar($client);
$calendarId = '0u6v0hj2ssssq6tun6nfpj9l60@group.calendar.google.com'; // The public "calendar ID"
$params = array(
	'singleEvents' => true,
	'orderBy' => 'startTime',
	'timeMin' => date(DateTime::ATOM), // Only future events
	'maxResults' => 25 // Number of next events to load
);

$events = $cal->events->listEvents($calendarId, $params); // Getting the data
$calTimeZone = $events->timeZone;
date_default_timezone_set($calTimeZone); // Set the timzone with the events (if different for some reason)

$count = 0; // This is just if we don't have any events later
$gcal = ""; // Just for creating the var
foreach ($events->getItems() as $event) {
	$eventDateStart = $event->start->dateTime; // Get the start time (if present)
	$eventDateEnd = $event->end->dateTime; // Get the end time (if present)

	if(empty($eventDateStart)) { // If there isn't any start time..
		// it's an all day event
		$eventDateStart = $event->start->date;
	}

	if(empty($eventDateEnd)) { // If there isn't any end time..
		// MAYBE it's an all day event
		$eventDateEnd = $event->end->date;
	}

	$gcal .= '<div class="list-group-item">
									<h4 class="list-group-item-heading">'. $event->summary .'</h4>
									<p class="list-group-item-text date">'. dateToDate($eventDateStart, $eventDateEnd) .'</p>
									<p class="list-group-item-text lieu">'. $event->location .'</p>
									';
	// It's not required to enter a description, but if there's one...
	if(!empty($event->description)) $gcal .= '<p class="list-group-item-text desc">'. linkify(nl2br($event->description)) .'</p>';
	$gcal .= '
								</div>
				';

	$count++;
}

// If there wasen't any events, then say there's nothing.
if($count == 0){
	$gcal = '
								<span class="list-group-item">
									<h4 class="list-group-item-heading">Aucun évènement futur prévu (pour l\'instant)</h4>
								</span>
	';
}

// Save to the "events.html" file
$cacheFileCal = fopen(__DIR__ ."/cache/events.html", "w") or die("Unable to open file!");
fwrite($cacheFileCal, $gcal);
fclose($cacheFileCal);
