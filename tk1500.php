<?php
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

session_start();

// Display the email from session
echo "<br> your email is " . htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8');

// Fetch the email from the session
$email = $_SESSION['email'];

// Prepare SQL statement to check if the record already exists
$sql = "SELECT * FROM ticket WHERE email = ?";
$stmt = $data->prepare($sql);
$stmt->bind_param("s", $email); // 's' denotes the type of the parameter (string)
$stmt->execute();
$result = $stmt->get_result();

// Check if the record exists
if ($result->num_rows > 0) {
    // Record exists, update the destination
    $sql = "UPDATE ticket SET fair = '1500Tk' WHERE email = ?";
    $stmt = $data->prepare($sql);
    $stmt->bind_param("s", $email); // 's' denotes the type of the parameter (string)
    $stmt->execute();
    header('location:route.html');
} else {
    // Record does not exist, insert a new row
    $sql = "INSERT INTO ticket (email, fair) VALUES (?, '1500Tk')";
    $stmt = $data->prepare($sql);
    $stmt->bind_param("s", $email); // 's' denotes the type of the parameter (string)
    $stmt->execute();
    header('location:route.html');
}

// Close the statement and connection
$stmt->close();
$data->close();
?>
