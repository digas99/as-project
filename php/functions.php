<?php

function getEventsInfo($number_events, $event, $depth) {
    $indexes = array($event-$depth);
    for ($i = 1; $i < 1+$depth*2; $i++) {
        $indexes[$i] = $indexes[$i-1]+1;
    }
    $number_current_events = count($indexes);
    $events_data = array();
    for ($x = 0; $x <= $number_current_events-1; $x++) {
        if ($indexes[$x] <= 0) $indexes[$x] = $number_events+$indexes[$x];
        if ($indexes[$x] >= $number_events+1) $indexes[$x] = $indexes[$x]-$number_events;
        
        // get event
        $query = "SELECT * FROM Events WHERE id = " . $indexes[$x];
        $result = mysqli_query($conn, $query);
        $events_data[] = mysqli_fetch_assoc($result);
    }
    print_r($events_data);
    return $events_data;
}

function apiFetch($endpoint) { 
    // Read JSON file
    $json_data = file_get_contents($endpoint);
    
    // Decode JSON data into PHP array
    $response_data = json_decode($json_data, true);
    return $response_data;
}