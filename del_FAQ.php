<?php
require_once 'config.php';
if(isset($_GET['id'])) {
  // Sanitize the input to prevent SQL injection
$event_id = $conn->real_escape_string($_GET['id']);
  // Prepare SQL statement to delete the event
$sql = "DELETE FROM event_faq WHERE `id` = '$event_id'";
  // Execute the SQL statement
if ($conn->query($sql) === TRUE) {
header('Location: landing_page.php');
exit();
} else {
    echo "<script>displayMessage('Unable to delete event: Either try contacting the owner or  aftersometime ', 'danger');</script>";
}
}