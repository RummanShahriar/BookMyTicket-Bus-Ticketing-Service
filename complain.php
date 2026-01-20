<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "test";

// Establish the connection
$con = mysqli_connect($host, $user, $password, $db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start the session
session_start();

// Get the user's email from the session
$email = $_SESSION['email'];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $complaintType = $_POST['complaintType'];
    $details = $_POST['details'];

    // Prepare and bind
    $stmt = mysqli_prepare($con, "INSERT INTO complaints (email, complaint_type, details) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $email, $complaintType, $details);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        header('location:help.html');
    } else {
        echo "Error: " . mysqli_error($con);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the connection
mysqli_close($con);
?>
