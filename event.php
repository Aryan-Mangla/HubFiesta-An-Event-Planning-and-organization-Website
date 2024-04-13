<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <!DOCTYPE html>
<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color: #F8F8FA;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
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
                <a class="nav-link active rounded-pill px-3  theme-bg theme-hover link-light" aria-current="page" href="#"> Home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-dark" href="#">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-dark" href="#">All Events</a>
            </li>
                
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
      
<form  action="event.php" method="post" enctype="multipart/form-data" >
<div class="container w-75  ">
  <h2 class="text-center fw-bold my-4">Create Event</h2>
  <div class="mb-3">
  <label for="status1">Status</label>
  <input name="status" id="status1" class="form-control" type="text"  aria-label="default input example" aria-describedby="statusHelp" required>
  <div id="statusHelp" class="form-text">Example: Free or Rs {Amount} </div>
  </div>
<div class="mb-3">
  <label for="title">Title</label>
  <input id="title" name="title" class="form-control" type="text" placeholder="Enter the Title " aria-label="default input example" required >
  </div>
  <div class="mb-3">
  <label for="date">Date</label>
  <input id="date" name="date" class="form-control" type="date"  aria-label="default input example" required >
  </div>
  <div class="mb-3">
  <label for="Location">Location</label>
  <input name="location" id="Location" class="form-control" type="text" placeholder="Enter location of event" aria-label="default input example" required >
  </div>
  

</div>
  <div class="container">
    <h2 class="text-center fw-bolder mt-4">Event Description</h2>
    <div class="mb-3">
  <label for="formFile" class="form-label">Image</label>
  <input name="image" class="form-control" type="file" id="formFile" accept="image/*" required>
</div>
<div class="form-floating">
  <textarea name="description" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" aria-describedby="textareaHelp" required></textarea>
  <label for="floatingTextarea2">Type Here</label>
  <div id="textareaHelp" class="form-text">Description must be short </div>

</div>
<button type="submit" class="btn theme-bg theme-hover text-light mt-3 w-100 p-2 " style="margin-bottom: 5rem;">Create Event</button>
  </div>
  </form>
</body>
</html>

<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Retrieve form data
$status = $_POST['status'];
$image = $_POST['image'];
$title = $_POST['title'];
$description = $_POST['description'];
$date = $_POST['date'];
$location = $_POST['location'];


// Prepare and execute SQL query to insert event details into the database
$sql = "INSERT INTO event_detail (status, image, title, description, date, location) VALUES ('$status', '$image', '$title', '$description', '$date', '$location')";

if ($conn->query($sql) === TRUE) {
    echo "Event added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
// Close the database connection
$conn->close();
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

</body>
</html>
