<?php
include 'connect.php';
if (isset($_POST['deleteid'])) {
    $id = $_POST['deleteid'];

    $sql = "DELETE FROM `registration` WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect to admin page after successful deletion
        header('location:admin_page.php');
    } else {
        die(mysqli_error($con));
    }

    $stmt->close();
}
?>
