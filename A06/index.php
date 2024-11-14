<?php
include('connect.php');

if (isset($_GET['deleteID'])) {
  $userInfoID = $_GET['deleteID'];
  $deleteQuery = "DELETE FROM userinfo WHERE userInfoID = '$userInfoID'";
  $result = executeQuery($deleteQuery);

  header("Location: index.php");
  exit;
}

$query = "SELECT firstName, lastName, age, contactNumber, userInfoID FROM userinfo ORDER BY userInfoID";
$result = executeQuery($query);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        body {
          font-family: 'Lato', sans-serif;
        }

        .custom-card {
          background-color: #b3cf99;
          transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .custom-card:hover {
          transform: scale(1.05);
          box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .title {
          font-weight: bold;
        }

        .add-image {
          width: 40px;
          height: 40px;
          cursor: pointer;
          transition: transform 0.3s ease;
        }

        .add-image:hover {
          transform: scale(1.1);
        }

        .modal-dialog {
          margin-top: 150px;
        }

        .modal-content {
            background-color: #f8f9fa;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background-color: #75975e;
            color: #fff;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg" style="background-color: #75975e;">
      <div class="container">
        <a class="navbar-brand text-white" href="#">User Records</a>
        <div class="d-flex">
          <a href="addUser.php">
            <img src="assets/add.png" alt="Add New User" class="add-image">
          </a>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="row mt-4">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 text-center">
            <div class="card mt-4 custom-card" data-bs-toggle="modal" data-bs-target="#userModal<?php echo $row['userInfoID']; ?>">
              <div class="card-body">
                <h5 class="title"><?php echo $row['firstName'] . " " . $row['lastName']; ?></h5>
                <p class="card-text"><?php echo $row['age'] . ' years old'; ?></p>
                <p class="card-text">Contact: <?php echo $row['contactNumber']; ?></p>
              </div>
            </div>
          </div>

          <div class="modal fade" id="userModal<?php echo $row['userInfoID']; ?>" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="userModalLabel">User Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <h5><?php echo $row['firstName'] . " " . $row['lastName']; ?></h5>
                  <p>Age: <?php echo $row['age']; ?> years old</p>
                  <p>Contact: <?php echo $row['contactNumber']; ?></p>
                </div>
                <div class="modal-footer">
                  <a href="index.php?deleteID=<?php echo $row['userInfoID']; ?>" class="btn btn-danger">Delete</a>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
