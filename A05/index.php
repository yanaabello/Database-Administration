<?php
include('connect.php');

$query = "SELECT firstName, lastName, age, contactNumber FROM userinfo ORDER BY userInfoID";
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

      .title{
        font-weight: bold;
      }
      
    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg" style="background-color: #75975e;">
      <div class="container">
        <a class="navbar-brand text-white" href="#">User Records</a>
      </div>
    </nav>

    <div class="container">
      <div class="row mt-4">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 text-center">
            <div class="card mt-4 custom-card">
              <div class="card-body">
                <h5 class="title"><?php echo $row['firstName'] . ' ' . $row['lastName']; ?></h5>
                <p class="card-text"><?php echo $row['age'] . ' years old'; ?></p>
                <p class="card-text">Contact: <?php echo $row['contactNumber']; ?></p>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </body>
</html>
