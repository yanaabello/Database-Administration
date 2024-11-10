<?php
include('connect.php');

if (isset($_POST['btnSubmit'])) {
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $age = $_POST['age'];
    $contact_number = $_POST['contactNumber'];

    $query = "INSERT INTO userinfo (firstName, lastName, age, contactNumber) 
              VALUES ('$first_name', '$last_name', '$age', '$contact_number')";
    $result = executeQuery($query);

    header("Location: index.php");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f7f7f7;">
    <nav class="navbar navbar-expand-lg" style="background-color: #75975e;">
      <div class="container">
        <a class="navbar-brand text-white" href="index.php">User Records</a>
        <div class="d-flex">
        </div>
      </div>
    </nav>

    <div class="container">
        <div class="row my-5">
            <div class="col-md-6 mx-auto">
                <div class="card p-3 text-center rounded-2" style="background-color: #b3cf99;">
                    <h3 class="mb-5">Add New User</h3>
                    <form method="POST" action="">
                        
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="contactNumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="contactNumber" name="contactNumber" required>
                        </div>

                        <button type="submit" name="btnSubmit" class="btn" style="background-color: #75975e; color: white;">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
