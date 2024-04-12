<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $name = htmlspecialchars($_POST['name']);
    if ($email && $password && $name) {
        // Generate a random salt
// $salt = bin2hex(random_bytes(16));

//concatinate password by hashing algo
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert user data into the database
        $insert_sql = "INSERT INTO it_event (Email, Password, Name) VALUES ('$email', '$hashed_password', '$name')";
        $insert_result = mysqli_query($conn, $insert_sql);
        if ($insert_result) {
            
            header("Location: log-in.html"); // Redirect to the sign-in page
            
        exit();
        } else {
            echo 'Error inserting data: ' . mysqli_error($conn);
        }

        
    } else {
        // Handle invalid input
        echo "Invalid input. Please fill in all fields correctly.";
    }
}

?>

<?php
// Close the database connection
$conn->close();
?>