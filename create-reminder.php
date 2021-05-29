<?php
require 'cal-conn.php';

// Refer to the PHP quickstart on how to setup the environment:
// https://developers.google.com/calendar/quickstart/php
// Change the scope to Google_Service_Calendar::CALENDAR and delete any stored
// credentials.
$client = getClient();
$service = new Google_Service_Calendar($client);

$summary = $_GET['summary']; // = user input
$desc = $_GET['desc']; // = user imput
$date = $_GET['rmdrDate']; // = user input

$event = new Google_Service_Calendar_Event(array(
    'summary' => $summary,
    'description' => $desc,
    'start' => array(
        'date' => $date,
        'timeZone' => 'America/Los_Angeles',
    ),
  'end' => array(
    'date' => $date,
    'timeZone' => 'America/Los_Angeles',
  ),
  // See https://tools.ietf.org/html/rfc5545#section-3.8.5 for Recurrence documentation
  'recurrence' => array(
    'RRULE:FREQ=DAILY;COUNT=1'
  ),
));

$calendarId = 'primary';
$event = $service->events->insert($calendarId, $event);
// if ($summary == null || $date == null ){
//   echo 
//   "<script>
//   setTimeout(function(){
//     window.location.href = 'crop-data.php';
//   </script>";
// }
// else {
// }

// How can I create error catch here for requiring a summary and date? 

  printf('Event created successfully: <strong>%s</strong>', $event['summary']);
  echo 
  "<script>
    setTimeout(function(){
      window.location.href = 'crop-data.php';
    }, 2500);
  </script>
  ";