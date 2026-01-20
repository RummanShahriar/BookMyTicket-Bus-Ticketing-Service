<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "test";

$data = mysqli_connect($host,$user,$password,$db);

if ($data == false) {
    die("Connection error: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM registration WHERE Username = '$username' AND password = '$password'";
    $result = mysqli_query($data, $sql);

    if (!$result) {
        die("Query Failed: " . mysqli_error($data));
    }

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        session_start();
        $email = $row['email'];
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        
        
        if ($row["usertype"] == "user") {
            // Redirect to user home with hidden form
            header('location:home.html');
        } elseif ($row["usertype"] == "admin") {
            // header('location:admin_page.php');
            header('location:admin_page.php');
        }
    } else {
        echo "Incorrect username or password";
    }
}
?>
