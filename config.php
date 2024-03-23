<?php

session_start(); // Start the session to store user authentication status

$servername = 'localhost';
$username = 'root';
$password = 'Aaryan@db';
$dbname = 'piet_event';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}