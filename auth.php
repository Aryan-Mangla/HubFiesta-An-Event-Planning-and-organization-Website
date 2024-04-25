<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve input
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    // Prepare SQL statement to retrieve user from the database
    $result = $conn->query("SELECT * FROM it_event WHERE Email = '$email'");
    if ($result->num_rows > 0) {
        // User found, verify password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['Password'])) {
            $_SESSION['email'] = $user['Email'];
            $_SESSION['ID'] = $user['S. No'];
            $_SESSION['user'] = $user['User_Name'];
            $_SESSION['loggedin'] = true;
            $_SESSION['admin'] = $user['admin'];
            header('Location: landing_page.php');
            exit();
        } else {
            echo 'Incorrect password';
            // Incorrect password
            $error = "Incorrect password";
        }
    } else {
        echo 'User not found';
        // User not found
        $error = "User not found";
    }
}
// Close the database connection
$conn->close();
