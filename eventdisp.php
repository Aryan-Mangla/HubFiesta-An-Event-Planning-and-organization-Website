<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require_once 'config.php';

// Check if the event ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the event ID to prevent SQL injection
    $event_id = $conn->real_escape_string($_GET['id']);

    // Prepare SQL statement to retrieve event details based on the event ID
    $sql = "SELECT * FROM event_detail WHERE `Event ID` = '$event_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Event details found, display them
        $event = $result->fetch_assoc();
        // Display event details
        echo '<h2>' . $event['title'] . '</h2>';
        echo '<p>' . $event['description'] . '</p>';
        echo '<p>Date: ' . $event['date'] . '</p>';
        echo '<p>Location: ' . $event['location'] . '</p>';
        // Add more event details as needed
    } else {
        echo "Event not found.";
    }
} else {
    echo "Event ID not provided.";
}
?>

</body>
</html>