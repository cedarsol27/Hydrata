<?php

require 'cal-conn.php';
// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Calendar($client);

// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$optParams = array(
  'maxResults' => 10,
  'orderBy' => 'startTime',
  'singleEvents' => true,
  'timeMin' => date('c'),
);
$results = $service->events->listEvents($calendarId, $optParams);
$events = $results->getItems();
$dispDate = getdate(date("U"));
echo "<br><p>Today is <em>$dispDate[weekday], $dispDate[month], $dispDate[mday], $dispDate[year]</em></p>";
if (empty($events)) {
    print "No upcoming events found.";
} else {
    echo "<p>Upcoming reminders:</p><div id='calendar'>";
    foreach ($events as $event) {
        $start = $event->start->dateTime;
        if (empty($start)) {
            $start = $event->start->date;
        }
        printf("%s || %s - %s", $start, $event->getSummary(), $event->getDescription());
        printf("<br>");
    }
    echo "</div>";
}