<?php
include 'connect.php';

// Check if 'updateid' is set in the POST data
if (isset($_POST['updateid'])) {
    $id = $_POST['updateid'];

    // Fetch the current user data from the database
    $sql = "SELECT * FROM `registration` WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if (!$user) {
        die("User not found.");
    }
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Username'])) {
    $Username = trim($_POST['Username']);
    $gender = trim($_POST['gender']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $number = trim($_POST['number']);

    // Validate form data
    if ($Username === "" || $gender === "" || $email === "" || $password === "" || $number === "") {
        echo "Please fill up all the information.";
    } else {
        // Update the user record
        $sql = "UPDATE `registration` SET Username=?, gender=?, email=?, password=?, number=? WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssi", $Username, $gender, $email, $password, $number, $id);

        if ($stmt->execute()) {
            // Redirect to admin page after successful update
            header('Location: admin_page.php');
            exit();
        } else {
            die(mysqli_error($con));
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <h1>Update User Information</h1>
                </div>
                <div class="panel-body">
                    <form action="" method="post">
                        <input type="hidden" name="updateid" value="<?php echo htmlspecialchars($id); ?>" />
                        <div class="form-group">
                            <label for="Username">User Name</label>
                            <input type="text" class="form-control" id="Username" name="Username" value="<?php echo htmlspecialchars($user['Username']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <div>
                                <label for="male" class="radio-inline">
                                    <input type="radio" name="gender" value="m" id="male" <?php if ($user['gender'] === 'm') echo 'checked'; ?> /> Male
                                </label>
                                <label for="female" class="radio-inline">
                                    <input type="radio" name="gender" value="f" id="female" <?php if ($user['gender'] === 'f') echo 'checked'; ?> /> Female
                                </label>
                                <label for="others" class="radio-inline">
                                    <input type="radio" name="gender" value="o" id="others" <?php if ($user['gender'] === 'o') echo 'checked'; ?> /> Others
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="number">Phone Number</label>
                            <input type="number" class="form-control" id="number" name="number" value="<?php echo htmlspecialchars($user['number']); ?>" />
                        </div>
                        <input type="submit" class="btn btn-primary my-3" value="Update" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
