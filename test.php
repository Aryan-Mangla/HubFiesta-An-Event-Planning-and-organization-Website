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
<?php
require_once 'config.php';
    // Checking if the user is logged in
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
      // If logged in, showing personalized content
      echo ' 
<nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
  <div class="container d-flex justify-content-evenly">
      <a class="navbar-brand" href="index.html"> <h2 class="my3 fw-bolder">Hub<span class="theme-txt">Fiesta</span></h2></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <ul class="nav nav-pill">
      <li class="nav-item">
          <a class="nav-link active rounded-pill px-3  theme-bg theme-hover link-light" aria-current="page" href="#"> Home </a>
      </li>
      <li class="nav-item">
          <a class="nav-link link-dark" href="#">Blog</a>
      </li>
      <li class="nav-item">
          <a class="nav-link link-dark" href="#">All Events</a>
      </li>
          <!-- Example HTML markup for the user dropdown menu -->
<div class="dropdown">
<div class="d-flex">

  <button class="btn  dropdown-toggle" type="button" id="userDropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
  <lord-icon
  src="https://cdn.lordicon.com/kthelypq.json"
  trigger="hover"
  >
</lord-icon>
  </button>
  <ul class="dropdown-menu"  aria-labelledby="userDropdownMenu">
      <li><a class="dropdown-item" href="#">Profile</a></li>
      <li><a class="dropdown-item" href="#">Settings</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="logout.php">Logout</a></li>
  </ul>
  </div>
</div>
      
    </ul>
      </div>
    </div>
  </div>
</nav>
'
;
  } else {
      // If not logged in, showing generic content
      header('Location: sign-in.html');
      
      ;
  }
    ?>


<?php

if(isset($_GET['id'])) {
    $event_id = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT * FROM event_detail WHERE `Event ID` = '$event_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Event details found, display them
        $event = $result->fetch_assoc();
        // Display event details
        echo '<div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="' . $event['image'] . '" class="img" style="max-width: 500px; max-height: 500px;" alt="">
                    </div>
                    <div class="col-md-6">
                        <h1>' . $event['title'] . '</h1>
                        <p>' . $event['description'] . '</p>
                        <p>Date and Time: ' . $event['date'] . '</p>
                        <p>Coordinators contact: ' . $event['Contact'] . '</p>
                        <!-- Add more event details as needed -->
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <h1>FAQs</h1>
                        <div id="accordionItems"></div>
<button id="addAccordionItemBtn" class="btn btn-primary">+</button>
                    </div>
                    <div class="col-md-6">
                        <p>Tags: ' . $event['Tag'] . '</p>
                        <p>Share with friends</p>
                    </div>
                </div>
            </div>';
        // Pass the event ID to JavaScript for dynamic loading of accordion items
        echo '<script>var eventId = ' . $event_id . ';</script>';
    } else {
        echo "Event not found.";
    }
}
?>






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