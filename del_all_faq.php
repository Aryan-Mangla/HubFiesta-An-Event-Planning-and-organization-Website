<?php
require_once 'config.php';

if(isset($_GET['id'])) {
  // Sanitize the input to prevent SQL injection
  $event_id = $conn->real_escape_string($_GET['id']);

  // Check if there are any records in the 'event_faq' table associated with the event ID
  $faq_sql = "SELECT * FROM event_faq WHERE event_id = '$event_id'";
  $faq_result = $conn->query($faq_sql);

  // Check if 'event_faq' is empty or the deletion is successful
  if ($faq_result->num_rows == 0) {
echo'Nothing to delete';
  } else {
  $sql = "DELETE FROM event_faq WHERE event_id = '$event_id'";
   if ($conn->query($sql) === TRUE){
    header("Location: test.php?id=" .$event_id );
   }else{
    echo'Something is wrong, contact the owner';
   }
}
}

