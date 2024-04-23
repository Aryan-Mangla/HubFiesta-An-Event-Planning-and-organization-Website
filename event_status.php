<?php
// Include database connection and sanitize input data
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eventId']) && isset($_POST['eventStatus'])) {
    $eventId = $conn->real_escape_string($_POST['eventId']);
    $eventStatus = $conn->real_escape_string($_POST['eventStatus']);
    
    // Update event status in the database
    $sql = "UPDATE event_detail SET event_signal = '$eventStatus' WHERE `Event ID` = '$eventId'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: landing_page.php");
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}

