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

session_start();
$email = $_SESSION['email'];
$flag = False;

// Use a prepared statement to securely query the database
$sql = "SELECT * FROM ticket WHERE email = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result) {
    if ($row = mysqli_fetch_assoc($result)) {
        $email = $row['email'];
        $destination =  $row['destination'];
        $bus =  $row['bus'];
        $type = $row['type'];
        $fair =  $row['fair'];
        $date =  $row['date'];
        $payment =  $row['payment'];
        $flag = True; 
    }
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($con);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookMyRide Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.html">BookMyRide</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="home.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="route.html">Route</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Payment Options
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="payment.html">Bkash</a></li>
                                <li><a class="dropdown-item" href="payment.html">PayPal <span
                                            class="badge text-bg-info">USA</span></a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="payment.html">Something else</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="ticket.php">Ticket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="help.html">Help</a>
                        </li>
                    </ul>
                    <div class="d-flex ms-auto">
                        <form class="d-flex me-2" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                        <button type="button" class="btn btn-outline-danger"
                            onclick="window.location.href='logout.php'">Logout</button>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
    <!-- ################### -->
        <?php if ($flag): ?>   
            <!-- ################### -->
            <div class="container my-4">
                <h2 class="text-center">Ticket Details</h2>
                <div class="row g-4 justify-content-center">
                    <div class="col-md-8">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title">Ticket Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="card-subtitle mb-2 text-muted">Traveler Information</h6>
                                        <p class="card-text">
                                            <strong>Email:</strong> <?php echo htmlspecialchars($email); ?>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="card-subtitle mb-2 text-muted">Trip Details</h6>
                                        <p class="card-text">
                                            <strong>Destination:</strong> <?php echo htmlspecialchars($destination); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="card-text">
                                            <strong>Bus:</strong> <?php echo htmlspecialchars($bus); ?>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="card-text">
                                            <strong>Type:</strong> <?php echo htmlspecialchars($type); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="card-text">
                                            <strong>Fare:</strong> <?php echo htmlspecialchars($fair); ?>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="card-text">
                                            <strong>Date:</strong> <?php echo htmlspecialchars($date); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="card-text">
                                            <strong>Payment Status:</strong> <?php echo htmlspecialchars($payment); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="container my-4">
                <h2 class="text-center">No Ticket Found</h2>
            </div>
        <?php endif; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
