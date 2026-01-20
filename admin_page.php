<?php
include 'connect.php';
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class='container'>
    <button type="button" class="btn btn-primary my-5" onclick="window.location.href='adduser.html'">Add User</button>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Username</th>
          <th scope="col">gender</th>
          <th scope="col">email</th>
          <th scope="col">password</th>
          <th scope="col">number</th>
          <th scope="col">usertype</th>
          <th scope="col">Operations</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $sql = "SELECT * FROM `registration`";
        $result = mysqli_query($con, $sql);
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];

            echo "<tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['Username'] . "</td>
            <td>" . $row['gender'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['password'] . "</td>
            <td>" . $row['number'] . "</td>
            <td>" . $row['usertype'] . "</td>
            <td>
              <form action='update.php' method='post' style='display:inline;'>
                <input type='hidden' name='updateid' value='" . $id . "' />
                <button type='submit' class='btn btn-primary'>Update</button>
              </form>
              <form action='delete.php' method='post' style='display:inline;'>
                <input type='hidden' name='deleteid' value='" . $id . "' />
                <button type='submit' class='btn btn-danger'>Delete</button>
              </form>
            </td>
          </tr>";
          }
        }
        ?>
        <button type="button" class="btn btn-danger my-5" onclick="window.location.href='logout.php'">Logout</button>
      </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </div>
</body>

</html>