<?php
require_once 'config.php';

if(isset($_GET['id'])) {
  $event_id = $conn->real_escape_string($_GET['id']);
  // Retrieve image file path from the database
  $image_sql = "SELECT image FROM event_detail WHERE `Event ID` = '$event_id'";
  $image_result = $conn->query($image_sql);
  if ($image_result->num_rows > 0) {
    $row = $image_result->fetch_assoc();
    $image_path = $row['image'];

    // Extract filename from image path
    $image_filename = basename($image_path);
    
    // Delete image file from the folder
    if(file_exists($image_path)) {
      unlink($image_path);
    }

  $faq_sql = "SELECT * FROM event_faq WHERE event_id = '$event_id'";
  $faq_result = $conn->query($faq_sql);
  if ($faq_result->num_rows == 0 || $conn->query("DELETE FROM event_faq WHERE event_id = '$event_id'") === TRUE) {
    $sql = "DELETE FROM event_detail WHERE `Event ID` = '$event_id'";
    if ($conn->query($sql) === TRUE) {
      header('Location: landing_page.php');
      exit();
    } else {
      echo "<script>displayMessage('Unable to delete event: Please try again later.', 'danger');</script>";
    }
  } else {
    echo "<script>displayMessage('Unable to delete event: Please try again later.', 'danger');</script>";
  }
}

}