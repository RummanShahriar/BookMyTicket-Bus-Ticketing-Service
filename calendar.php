<?php
session_start();

$date = $_POST['dateInput'];
$host = "localhost";
$user = "root";
$password = "";
$db = "test";

// Establish the connection
$data = mysqli_connect($host, $user, $password, $db);

// Check connection
if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

// Display the email from session
$email = htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8');

// Check if the date is provided
if (empty($date)) {
    die("No date provided.");
}

// Prepare SQL statement to check if the record already exists
$sql = "SELECT * FROM ticket WHERE email = ?";
$stmt = $data->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if the record exists
if ($result->num_rows > 0) {
    // Record exists, update the date
    $sql = "UPDATE ticket SET date = ? WHERE email = ?";
    $stmt = $data->prepare($sql);
    $stmt->bind_param("ss", $date, $email);
    $stmt->execute();
} else {
    // Record does not exist, insert a new row
    $sql = "INSERT INTO ticket (email, date) VALUES (?, ?)";
    $stmt = $data->prepare($sql);
    $stmt->bind_param("ss", $email, $date);
    $stmt->execute();
}

// Redirect to route.html after the operation
header('Location: route.html');

// Close the statement and connection
$stmt->close();
$data->close();
?>
