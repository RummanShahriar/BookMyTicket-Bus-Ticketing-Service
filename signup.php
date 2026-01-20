<?php
	$Username = $_POST['Username'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$number = $_POST['number'];

	// Database connection
	$conn = new mysqli('localhost','root','','test');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
        if($Username !== "" and $gender !== "" and $email !== "" and $password !== "" and $number !== "" ) {
            $stmt = $conn->prepare("insert into registration(Username, gender, email, password, number) values(?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $Username, $gender, $email, $password, $number);
            $execval = $stmt->execute();
            // echo $execval;
			header('location:form.html');
            exit();
        }
        else {
			echo "Please Fill Up all the informations</br>";
            echo "$conn->connect_error";
		    die("Connection Failed : ". $conn->connect_error);
        }

	}
?>