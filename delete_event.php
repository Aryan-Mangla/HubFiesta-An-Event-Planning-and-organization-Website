<?php
require_once 'config.php';

if(isset($_GET['id'])) {
  // Sanitize the input to prevent SQL injection
  $event_id = $conn->real_escape_string($_GET['id']);

  // Check if there are any records in the 'event_faq' table associated with the event ID
  $faq_sql = "SELECT * FROM event_faq WHERE event_id = '$event_id'";
  $faq_result = $conn->query($faq_sql);

  // Check if 'event_faq' is empty or the deletion is successful
  if ($faq_result->num_rows == 0 || $conn->query("DELETE FROM event_faq WHERE event_id = '$event_id'") === TRUE) {
    // Attempt to delete records from the 'event_detail' table
    $sql = "DELETE FROM event_detail WHERE `Event ID` = '$event_id'";
    if ($conn->query($sql) === TRUE) {
      // If both deletions are successful, redirect to landing_page.php
      header('Location: landing_page.php');
      exit();
    } else {
      // If deleting from 'event_detail' fails, display an error message
      echo "<script>displayMessage('Unable to delete event: Please try again later.', 'danger');</script>";
    }
  } else {
    // If deleting from 'event_faq' fails, display an error message
    echo "<script>displayMessage('Unable to delete event: Please try again later.', 'danger');</script>";
  }
}

