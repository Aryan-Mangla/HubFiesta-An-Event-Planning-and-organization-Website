<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>testing</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body >
  <!-- Nav Bar -->
  <nav class="navbar mb-5 sticky-top navbar-expand-lg bg-body-tertiary">
  <div class="container d-flex justify-content-evenly">
      <a class="navbar-brand" href="index.html"> <h2 class="my3 fw-bolder">Hub<span class="theme-txt">Fiesta</span></h2></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <ul class="nav nav-pill">
        <?php
        require_once 'config.php';
    // Checking if the user is logged in
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
      // If logged in, showing personalized content
      echo '
      <li class="nav-item">
          <a class="nav-link  px-3  link-dark" aria-current="page" href="landing_page.php"> Home </a>
      </li>
      <li class="nav-item">
          <a class="nav-link link-dark" href="blog.php">Blog</a>
      </li>
      <li class="nav-item">
          <a class="nav-link link-dark" href="eventdisp.php">All Events</a>
      </li>
          <!-- Example HTML markup for the user dropdown menu -->
<div class="dropdown">
<div class="d-flex">
  <button class="btn  dropdown-bs-toggle" type="button" id="userDropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
  <lord-icon
  src="https://cdn.lordicon.com/kthelypq.json"
  trigger="hover"
  >
</lord-icon>';
echo'  </button><p class="pt-2">'.$_SESSION['user'].'</p>
  <ul class="dropdown-menu"  aria-labelledby="userDropdownMenu">
      <li><a class="dropdown-item" href="#">Profile</a></li>
      <li><a class="dropdown-item" href="#">Settings</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="logout.php">Logout</a></li>
  </ul>
  </div>
</div>
      '
      ;
  } else {
      // If not logged in, showing generic content
      echo '
      <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="log-in.html">Login</a>
          <a class="nav-link" href="sign-in.html">Signup</a>
      </div> 
      '
      ;
  }
    ?>
    </ul>
      </div>
    </div>
  </div>
</nav>
<?php
if (isset($_GET['id'])) {
  $event_id = $conn->real_escape_string($_GET['id']);
  $sql = "SELECT * FROM event_detail WHERE `Event ID` = '$event_id'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      $event = $result->fetch_assoc();
      $event['date'] = date('d-F-Y', strtotime($event['date']));
      $event['st_time'] = date("H:i", strtotime($event['st_time']));
      $event['end_time'] = date("H:i", strtotime($event['end_time']));
      $fileExtension = strtolower(pathinfo($event['image'], PATHINFO_EXTENSION));
// switch ($fileExtension) {
//     case 'png':
//         $sourceImage = imagecreatefrompng($event['image']);
//         break;
//     case 'jpg':
//     case 'jpeg':
//         $sourceImage = imagecreatefromjpeg($event['image']);
//         break;
// }
// $desiredWidth = 1500;
// $desiredHeight = 700;
// $newImage = imagecreatetruecolor($desiredWidth, $desiredHeight);
// imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, imagesx($sourceImage), imagesy($sourceImage));
// // header('Content-Type: image/jpeg');
// ob_start();
// imagejpeg($newImage, null, 100);
// $imageData = ob_get_clean();
// // Free up memory by destroying the images
// imagedestroy($sourceImage);
// imagedestroy($newImage);
//src data:image/jpeg;base64,'.base64_encode($imageData).'

      // Display event details
      echo '<div class="container-fluid">
      <div class="row">
<!--      <div class="container">
<a href="landing_page.php" class="btn theme-bg theme-hover text-white mb-5"> Back</a>
</div> -->
        <div class="text-center">
          <img src="'.$event['image'].'" class="img-fluid mb-5" style="width:1500px;height:700px;"  alt="Event Flyer">
        </div> 
      </div>
      <div class="container">
      <div class="row">
      <div class="col-md-6">
      <h1>' . $event['title'] . '</h1>
      <div>
        <h3 class="mt-5 fs-1"> Description </h3>
        <p style="text-align: justify;">' . $event['description'] . '</p>
      </div>
      <div>
        <h3 class="fw-bold fs-4">Date and Time: </h3>
        <div class="d-flex justify-content-between">
        <span>
          <p> Date: ' . $event['date'] . '</p>
          <p> Day: ' . $event['Day'] . '</p>
        </span>
        <span class="ms-3">
          <p> Starting Time: ' . $event['st_time'] . '</p>
          <p> Ending Time: ' . $event['end_time'] . '</p>
        </span>
        </div>
      </div>
      <p class="fw-bold fs-2">Coordinator Detail: </p>
      <p> Name: <span class="theme-txt fw-bold">'.$event['org_name'].'</span></p>
      <p> Phone Number: <span class="theme-txt fw-bold">'. $event['Contact'] . '</span></p>
  </div>
        <div class="col-md-6">
          <div class="d-flex justify-content-between align-items-center">
          ';
            echo'<h1>FAQs</h1>';
                      // if admin then special option
                      if (isset($_SESSION['admin']) && $_SESSION['admin'] === '1') {
                         echo'
                          <span><a href="accordion_page.php?id=' . $event_id . '" class="btn theme-bg theme-hover text-white">Add FAQ</a><a href="del_all_faq.php?id=' . $event_id . '" class="btn theme-bg theme-hover text-white mx-2">Delete all FAQ</a></span>
                          ';
                      }
            echo'
          </div>';
          // Fetch accordion items associated with the event ID
          $faq_sql = "SELECT * FROM event_faq WHERE event_id = '$event_id'";
          $faq_result = $conn->query($faq_sql);
          if ($faq_result->num_rows > 0) {
            echo '<div class="accordion accordion-flush" id="accordionFlushExample">';
        while ($faq = $faq_result->fetch_assoc()) {
            echo '<div class="accordion-item border rounded">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse' . $faq['id'] . '" aria-expanded="false" aria-controls="faqCollapse' . $faq['id'] . '">
                            ' . $faq['title'] . '
                        </button>
                    </h2>
                    <div id="faqCollapse' . $faq['id'] . '" class="accordion-collapse collapse" aria-labelledby="flush-heading' . $faq['id'] . '" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body" style="overflow-wrap: break-word;">
                            ' . $faq['content'] . '';
                            // if admin then special option
                      if (isset($_SESSION['admin']) && $_SESSION['admin'] === '1') {
                         echo'   <p> FAQ id:'.$faq['id']. '</p>
                            <a href="del_FAQ.php?id=' . $faq['id'] . '" class="delete-icon float-end" title="Delete event">
            <lord-icon src="https://cdn.lordicon.com/wpyrrmcq.json" trigger="hover" style="width:30px;height:30px"></lord-icon>
            </a>';}
                    echo'    </div>
                    </div>
                </div>';
        }
        echo '</div>'; // Close accordion
    }
     else {
              echo '<p>No FAQs available for this event.</p>';
          }
                  echo'</div>
    </div>';//row 1 ended

echo'  <div class="row mb-5">
<div class="col-md-6">';
      $tags = explode(',', $event['Tag']); // Assuming tags are comma-separated in the database
      echo '<p class="fs-3 fw-bold">Tags</p>'; 
      foreach ($tags as $tag) {
          echo '<span class="badge p-2 dropdown-bg text-dark fs-6">' . $tag . '</span> ';
      }
          echo'<p>Share with friends</p>
                      </div>
              </div>
          </div>
          </div>';
  } else {
      echo "Event not found.";
  }
  
}
?>

<!-- Other events -->
<div class="container-fluid p-2" style="background-color: #F2F2F2;">
<div class="container my-5" >
<h4 class="fw-bold mb-4">Other events you may like</h4>
<?php
$sql = "SELECT * FROM (SELECT * FROM event_detail ORDER BY `Event ID` DESC LIMIT 6) AS LastSix ORDER BY `Event ID` ASC;"; // Assuming 'date' is a column representing the event date
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $counter = 0;
  // Start a new row
  echo '<div class="row">';
  // Loop through each row of the result set
  while($row = $result->fetch_assoc()) {
      // Skip printing the event if its ID matches $event_id
      if ($row['Event ID'] == $event_id) {
          continue;
      }
      $row['date'] = date('d-F-Y', strtotime($row['date']));
      $row['st_time'] = date("H:i", strtotime($row['st_time']));
      echo '<div class="col-md-4">';
      echo '<div class="card my-4 d-flex justify-content-center align-items-center" style="box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5);">';
      echo '<div style="width: 85%;">';
      echo '<span class="badge text-bg-light position-absolute" style="z-index: 1; top: 6%; left: 10%;">' . $row['status'] . '</span>';
      echo '<img src="' . $row['image'] . '" class="card-img-top mt-3 position-relative" style="max-width: 348px; max-height: 240px;" alt="...">';
      echo '</div>';
      echo '<div class="card-body">';
      echo '<h5 class="card-title">' . $row['title'] . '</h5>';
      echo '<p class="card-text d-inline-block module"  >' . $row['description'] . '</p>';
      echo '<p class="card-text theme-txt">' . $row['date'] . ', <span>'.$row['st_time'] .'</span</p>';
      echo '<p class="card-text text-secondary">' . $row['location'] . '</p>';
      echo '<p class="card-text text-secondary">Event ID: ' . $row['Event ID'] . '</p>';
      echo '<a href="test.php?id=' . $row['Event ID'] . '" class="btn theme-bg theme-hover text-white">Read More</a>';
      // Conditionally display the delete anchor if the user is an admin
      if (isset($_SESSION['admin']) && $_SESSION['admin'] === '1') {
          echo '<a href="delete_event.php?id=' . $row['Event ID'] . '" class="delete-icon float-end" title="Delete event">';
          echo '<lord-icon src="https://cdn.lordicon.com/wpyrrmcq.json" trigger="hover" style="width:30px;height:30px"></lord-icon>';
          echo '</a>';
      }
      echo '</div>';
      echo '</div>';
      echo '</div>';
      $counter++;
      if ($counter % 3 == 0) {
          echo '</div>'; // Close current row
          echo '<div class="row">'; // Start new row
      }
  }
  // Close the final row
  echo '</div>';
} else {
  echo "No events found.";
}?>
</div>
</div>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
<script src="https://cdn.lordicon.com/lordicon.js"></script>

<script src="script/script.js"></script>

</body>
</html>