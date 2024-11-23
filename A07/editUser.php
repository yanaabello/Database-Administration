<?php
include('connect.php');

if (isset($_GET['editID'])) {
    $userInfoID = $_GET['editID'];
    $query = "SELECT * FROM userinfo WHERE userInfoID = '$userInfoID'";
    $result = executeQuery($query);

    if (mysqli_num_rows($result) > 0) {
        while ($user = mysqli_fetch_assoc($result)) {
            $first_name = $user['firstName'];
            $last_name = $user['lastName'];
            $age = $user['age'];
            $contact_number = $user['contactNumber'];
        }
    } else {
        header("Location: index.php");
        exit;
    }
}

if (isset($_POST['btnUpdate'])) {
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $age = $_POST['age'];
    $contact_number = $_POST['contactNumber'];

    $updateQuery = "UPDATE userinfo SET 
        firstName = '$first_name', 
        lastName = '$last_name', 
        age = '$age', 
        contactNumber = '$contact_number' 
        WHERE userInfoID = '$userInfoID'";

    executeQuery($updateQuery);

    header("Location: index.php");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .back-image {
          width: 35px;
          height: 35px;
          cursor: pointer;
          transition: transform 0.3s ease;
    }

    .back-image:hover {
          transform: scale(1.1);
    }
</style>

<body style="background-color: #f7f7f7;">
    <nav class="navbar navbar-expand-lg" style="background-color: #75975e;">
      <div class="container">
        <a class="navbar-brand text-white" href="index.php">User Records</a>
        <div class="d-flex">
        <a href="index.php">
            <img src="assets/back.png" alt="Back to User List" class="back-image">
          </a>
        </div>
      </div>
    </nav>

    <div class="container">
        <div class="row my-5">
            <div class="col-md-6 mx-auto">
                <div class="card p-3 text-center rounded-2" style="background-color: #b3cf99;">
                    <h3 class="mb-5">Edit User</h3>
                    <form method="POST" action="">
                        
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $first_name; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $last_name; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" value="<?php echo $age; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="contactNumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="contactNumber" name="contactNumber" value="<?php echo $contact_number; ?>">
                        </div>

                        <button type="submit" name="btnUpdate" class="btn" style="background-color: #75975e; color: white;">Update</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
