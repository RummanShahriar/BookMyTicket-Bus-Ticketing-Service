<?php
    $destination = $_POST['destination'];
    $bus = $_POST['bus'];
    $type = $_POST['ac'];
    $fair = $_POST['fair'];
    $date = $_POST['date'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'test');
    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed: " . $conn->connect_error);
    } else {
        if ($destination !== "" && $bus !== "" && $ac !== "" && $fair !== "" && $date !== "") {
            $stmt = $conn->prepare("INSERT INTO ticket(destination, bus, type, fair, date) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $destination, $bus, $ac, $fair, $date);
            $execval = $stmt->execute();
            // echo $execval;
            header('Location: route.html');
            $stmt->close();
            $conn->close();
        } else {
            echo "Please fill up all the information.</br>";
            echo "$conn->connect_error";
            die("Connection Failed: " . $conn->connect_error);
        }
    }
?>
