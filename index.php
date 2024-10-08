<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!-- Nav Bar -->
<nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary">
  <div class="container d-flex justify-content-evenly">
      <a class="navbar-brand" href="index.php"> <h2 class="my3 fw-bolder">Hub<span class="theme-txt">Fiesta</span></h2></a>
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
          <a class="nav-link active rounded-pill px-3  theme-bg theme-hover link-light" aria-current="page" href="#"> Home </a>
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
      <li><a class="dropdown-item" href="#">Messages</a></li>
      <li><a class="dropdown-item" href="#">My Events</a></li>
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

<!-- Carousel -->
<div class="d-flex justify-content-center align-items-center">
<div id="carouselExampleSlidesOnly" class="carousel slide my-5" data-bs-ride="carousel" style="width: 95%;" >
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="Pic/index/one.png" class="d-block w-100" alt="Banner 1">
    </div>
    <div class="carousel-item">
      <img src="Pic/index/one.png" class="d-block w-100" alt="Banner 2">
    </div>
    <div class="carousel-item">
      <img src="Pic/index/one.png" class="d-block w-100" alt="Banner 3">
    </div>
  </div>
</div>
</div>

<!-- Events -->
<div class="container my-5">
  <div class="d-flex justify-content-between">
    <h4 class="my3 fw-bolder">Upcoming<span class="theme-txt">Events</span></h4>
    <!-- Dropdowns -->
    <div>
    <!-- Dropdown 1 -->
    <div class="btn-group">
      <button type="button" class="btn   dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Weekdays
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Monday</a></li>
        <li><a class="dropdown-item" href="#">Tuesday</a></li>
        <li><a class="dropdown-item" href="#">Wednesday</a></li>
        <li><a class="dropdown-item" href="#">Thursday</a></li>
        <li><a class="dropdown-item" href="#">Friday</a></li>
        <li><a class="dropdown-item" href="#">Saturday</a></li>
        <li><a class="dropdown-item" href="#">Sunday</a></li>
      </ul>
    </div>
    <!-- Dropdown 2 -->
    <div class="btn-group">
      <button type="button" class="btn   dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Event Type
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Culture</a></li>
        <li><a class="dropdown-item" href="#">Technical</a></li>
      </ul>
    </div>
  </div>
  </div> <!--Event navbar end-->
<!-- Display Message -->
<div id="messageContainer"></div>
<!-- Dynamically Creates Event -->
    <?php
// Fetch latest 6 event details from the database
$sql = "SELECT * FROM (SELECT * FROM event_detail ORDER BY `Event ID` DESC LIMIT 6) AS LastSix ORDER BY `Event ID` ASC;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // Start the row-cols container
  echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
  // Loop through each row of the result set
  while($row = $result->fetch_assoc()) {
    $event_signal =$row['event_signal'];
      $row['date'] = date('d-F-Y', strtotime($row['date']));
      $row['st_time'] = date("H:i", strtotime($row['st_time']));
      // Start a column
      echo '<div class="col">';
      // Start a card
      echo '<div class="card h-100  my-3 d-flex justify-content-center align-items-center" style="box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5);">';
      echo '<div class="text-center" style="width: 85%;">';
      echo '<span class="badge  position-absolute '; if($row['event_signal']==='Active'){echo'active_signal';}else{echo'expired_signal';}echo'" style="z-index: 1; top: 6%; left: 10%;">' . $row['status'] . '</span>';
      echo '<img src="' . $row['image'] . '" class="card-img-top mt-3 mx-auto position-relative" style="max-width: 348px; max-height: 240px;" alt="...">';
      echo '</div>';
      // Card body
      echo '<div class="card-body">';
      // Title
      echo '<h5 class="card-title">' . $row['title'] . '</h5>';
      echo '<p class="card-text d-inline-block module"  >' . $row['description'] . '</p>';
      echo '<p class="card-text theme-txt">' . $row['date'] . ', <span>'.$row['st_time'] .'</span</p>';
      echo '<p class="card-text text-secondary module">' . $row['location'] . '</p>';
      echo '<p class="card-text text-secondary">Event ID: ' . $row['Event ID'] . '</p>';
      echo '<a href="test.php?id=' . $row['Event ID'] . '" class="btn theme-bg theme-hover text-white mt-1">Read More</a>';      // Delete icon (assuming the user is an admin)
    if (isset($_SESSION['admin']) && $_SESSION['admin'] === '1') {
        echo '<a href="delete_event.php?id=' . $row['Event ID'] . '" class="delete-icon float-end" title="Delete event">';
        echo '<lord-icon src="https://cdn.lordicon.com/wpyrrmcq.json" trigger="hover" style="width:30px;height:30px"></lord-icon>';
        echo '</a>';
        echo '<form method="post" action="event_status.php">';
        echo '    <div class="mt-3 d-flex">';
        echo '        <select class="form-select me-1 w-50" id="eventStatus" name="eventStatus">';
        echo '            <option value="Active" ' . (($event_signal == 'Active') ? 'selected' : '') . '>Active</option>';
        echo '            <option value="Expired" ' . (($event_signal == 'Expired') ? 'selected' : '') . '>Expired</option>';
        echo '        </select>';
        echo '        <input type="hidden" name="eventId" value="' . $row['Event ID'] . '">';
        echo '        <button type="submit" class="btn btn-secondary" id="updateStatusBtn">Update Status</button>';
        echo '    </div>';
        echo '</form>';
    }

    
      // End card body
      echo '</div>';
      // End card
      echo '</div>';
      // End column
      echo '</div>';
  }
  // End the row-cols container
  echo '</div>';
} else {
  echo "No events found.";
}

if(isset($_GET['id'])) {
  // Sanitize the input to prevent SQL injection
  $event_id = $conn->real_escape_string($_GET['id']);

  // Prepare SQL statement to delete the event
  $sql = "DELETE FROM event_detail WHERE `Event ID` = '$event_id'";

  // Execute the SQL statement
  if ($conn->query($sql) === TRUE) {
    echo "<script>displayMessage('Event Deleted Successfully', 'success');</script>";
      exit();
  } else {
    echo "<script>displayMessage('Unable to delete event: Either try contacting the owner or  aftersometime ', 'danger');</script>";
  }
}
// Close the database connection
$conn->close();
?>
<!-- end -->
</div>
<!--Event Registration -->
<div class="container-fluid d-flex justify-content-evenly align-items-center" style="background-color: #10107B;margin-top:10rem">
<div class="col-md-6">
  <img src="Pic/index/Create event/image 3.png" class="img-fluid position-relative" style="top: -50px;" alt="">
</div>
<div class="col-md-6 p-3 text-light">
  <h3>Make your own Event </h3>
<?php  // if admin then special option
if (isset($_SESSION['admin']) && $_SESSION['admin'] === '1') {
echo'<a href="event.php" class="btn theme-bg theme-hover text-white">Create Events</a>';}
else{
  echo'<a href="event.php" class="btn theme-bg theme-hover text-white disabled">Create Events</a>';
}
?>
</div>
</div>
<!-- Clubs -->
<h4 class="mt-5 fw-bolder text-center">Our<span class="theme-txt">Clubs</span></h4>
<p class="text-center fw-bolder">We've had the pleasure of working with these clubs of Panipat Institute of Engineering and Technology.</p>
<div class="row">
  <div class="col-md-3">
    <img src="Pic/index/Clubs/stripe.png" alt="">
  </div>
  <div class="col-md-3">
    <img src="Pic/index/Clubs/technogear head logo, transparent (2).png" class="w-50" alt="">
  </div>
  <div class="col-md-3"></div>
  <div class="col-md-3"></div>
</div>
<!-- Our Blog -->
<div class="container my-5">
<div class="d-flex justify-content-between">
  <h4 class="my3 fw-bolder">Our<span class="theme-txt">Blogs</span></h4>
</div>
<!-- Cards Row 1 -->
<div class="my-3 d-md-flex justify-content-evenly">
  <!-- Card 1 -->
  <div class="card my-4 d-flex justify-content-center align-items-center" style="width: 25rem; box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5);">
    <div style="width: 85%;">
    <img src="Pic/index/events/image3.png" class="card-img-top mt-3 position-relative " alt="...">
  </div>
    <div class="card-body">
      <h5 class="card-title">Bootcamp</h5>
      <p class="card-text">BestSelller Book Bootcamp -write, Market & Publish Your Book -Lucknow</p>
      <p class="card-text theme-txt">Saturdat, March 18, 9.30PM</p>

      <a href="#" class="btn theme-bg theme-hover text-white">Read</a>
    </div>
  </div>
  <!-- Card 2 -->
  <div class="card my-4 d-flex justify-content-center align-items-center" style="width: 25rem; box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5);">
    <div style="width: 85%;">
    <img src="Pic/index/events/e 2.png" class="card-img-top mt-3 position-relative " alt="...">
  </div>
    <div class="card-body">
      <h5 class="card-title">Holi</h5>
      <p class="card-text">Holi Celebration - Festival of Colors at Panipat Institure of Engineering and Technology</p>
      <p class="card-text theme-txt">Friday, March 22, 2:00 PM</p>
      
      <a href="#" class="btn theme-bg theme-hover text-white">Read</a>
    </div>
  </div>
  <!-- Card 3 -->
  <div class="card my-4 d-flex justify-content-center align-items-center" style="width: 25rem; box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5);">
    <div style="width: 85%;">
    <img src="Pic/index/events/e 5.png" class="card-img-top mt-3 position-relative " alt="...">
  </div>
    <div class="card-body">
      <h5 class="card-title">Bootcamp</h5>
      <p class="card-text">BestSelller Book Bootcamp -write, Market & Publish Your Book -Lucknow</p>
      <p class="card-text theme-txt">Saturdat, April 18, 9.30PM</p>

      <a href="#" class="btn theme-bg theme-hover text-white">Read</a>
    </div>
  </div>
</div>
</div>

<!-- Footer -->
<div class="container-fluid mt-5 " style="background-color: #10107B;">
  <div class="d-flex justify-content-center align-items-center">
    <div>
  <h4 class="mt-5 fw-bolder fs-1 text-light text-center">Hub<span class="theme-txt">Fiesta</span></h4>
  <form class="d-flex justify-content-center align-items-center my-4">
    <div class="">
      <!-- <label for="exampleInputEmail1" class="form-label">Email address</label> -->
      <input type="email" class="form-control" style="width: 20rem;" placeholder="Enter Your mail" id="exampleInputEmail1" aria-describedby="emailHelp">
      <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
    </div>
    <button type="submit" class="btn theme-bg theme-hover text-light mx-3 w-25">Subscribe</button>
  </form>
  <div class="my-5">
    <ul class="d-md-flex p-0 my-3" style="list-style-type: none">
      <li><p style="font-size: 20px"><a class="text-white mx-5" style="text-decoration: none;" href="index.html">Home</a></p></li>
      <li><p style="font-size: 20px"><a class="text-white mx-5" style="text-decoration: none;" href="services.html">Services</a></p></li>
      <li><p style="font-size: 20px"><a class="text-white mx-5" style="text-decoration: none;" href="about.html">About Us</a></p></li>
      <li><p style="font-size: 20px"><a class="text-white mx-5" style="text-decoration: none;" href="contact.html">Contact Us</a></p></li>
    </ul>
  </div>
</div>
</div>
<hr class="text-light">
<div class="d-flex justify-content-center align-items-center">
<p class="text-light">Copyrighted © 2024 Upload by HubFiesta
</p>
</div>
<a href="https://lordicon.com/">Icons by Lordicon.com</a>
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