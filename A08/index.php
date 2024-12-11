<?php
include("connect.php");

$airlineNameFilter = $_GET['airlineName'] ?? '';
$sort = $_GET['sort'] ?? '';
$order = $_GET['order'] ?? '';

$flightlogsQuery = "SELECT * FROM flightlogs";

if ($airlineNameFilter != '') {
    $flightlogsQuery .= " WHERE airlineName LIKE '%$airlineNameFilter%'";
}

if ($sort != '') {
    $flightlogsQuery .= " ORDER BY $sort";

    if ($order != '') {
        $flightlogsQuery .= " $order";
    }
}

$flightResults = executeQuery($flightlogsQuery);

$airlineNamesQuery = "SELECT DISTINCT(airlineName) FROM flightlogs";
$airlineNamesResults = executeQuery($airlineNamesQuery);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PUP Airport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .card table,
        .card table tr,
        .card table th,
        .card table td {
            background-color: #343a40;
            color: white;
            overflow: hidden;
        }

        .card {
            max-width: 100%;
            overflow: hidden;
        }

        .card table {
            table-layout: fixed;
            width: 100%;
        }

        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body style="background-color: #7fbcdd; font-family: Arial, sans-serif;">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #343a40;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/img/logo.png" alt="logo" width="100" height="40" style="margin-left: -10px;">
            </a>
        </div>
    </nav>

    <div class="container mb-5 mt-5">
        <div class="row">
            <div class="col text-center">
                <div class="display-5" style="font-family: Tahoma, sans-serif; font-weight: bold; color: #343a40;">
                    PUP Airport
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 50px;">
        <div class="row my-5">
            <div class="col">
                <form>
                    <div class="card p-4 rounded-5"
                        style="background-color: #343a40; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <div class="h6" style="font-size: 20px; font-weight: bold; color: white;">
                            Filter and Sort
                        </div>
                        <div class="d-flex flex-column flex-md-row align-items-start">
                            <label for="airlineNameSelect" class="m-2" style="color: white;">Airline Name</label>
                            <select id="airlineNameSelect" name="airlineName" class="ms-2 form-control"
                                style="max-width: 250px;">
                                <option value="">Any</option>
                                <?php
                                if (mysqli_num_rows($airlineNamesResults) > 0) {
                                    while ($airlineNameRow = mysqli_fetch_assoc($airlineNamesResults)) {
                                        ?>
                                        <option <?php if ($airlineNameFilter == $airlineNameRow['airlineName']) {
                                            echo "selected";
                                        } ?> value="<?php echo $airlineNameRow['airlineName'] ?>">
                                            <?php echo $airlineNameRow['airlineName'] ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>

                            <label for="sort" class="m-2" style="color: white;">Sort By</label>
                            <select id="sort" name="sort" class="ms-2 form-control" style="max-width: 250px;">
                                <option value="">None</option>
                                <option <?php if ($sort == "flightNumber") {
                                    echo "selected";
                                } ?> value="flightNumber">Flight Number</option>
                                <option <?php if ($sort == "airlineName") {
                                    echo "selected";
                                } ?> value="airlineName">Airline Name</option>
                                <option <?php if ($sort == "passengerCount") {
                                    echo "selected";
                                } ?> value="passengerCount">Passenger Count</option>
                                <option <?php if ($sort == "departureDatetime") {
                                    echo "selected";
                                } ?> value="departureDatetime">Departure</option>
                                <option <?php if ($sort == "arrivalDateTime") {
                                    echo "selected";
                                } ?> value="arrivalDateTime">Arrival</option>
                            </select>

                            <label for="order" class="m-2" style="color: white;">Order</label>
                            <select id="order" name="order" class="ms-2 form-control" style="max-width: 250px;">
                                <option <?php if ($order == "ASC") {
                                    echo "selected";
                                } ?> value="ASC">Ascending</option>
                                <option <?php if ($order == "DESC") {
                                    echo "selected";
                                } ?> value="DESC">Descending</option>
                            </select>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary ms-2 mt-4" type="submit"
                                style="width: fit-content;">Submit</button>
                            <a href="index.php" class="btn btn-secondary ms-2 mt-4"
                                style="width: fit-content;">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row my-5">
            <div class="col">
                <div class="card p-4 rounded-5"
                    style="background-color: #343a40; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="table-responsive">
                        <table class="table table-sm text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Flight Number</th>
                                    <th scope="col">Airline Name</th>
                                    <th scope="col">Passenger Count</th>
                                    <th scope="col">Departure</th>
                                    <th scope="col">Arrival</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($flightResults) > 0) {
                                    while ($flightRow = mysqli_fetch_assoc($flightResults)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $flightRow['flightNumber'] ?></td>
                                            <td><?php echo $flightRow['airlineName'] ?></td>
                                            <td><?php echo $flightRow['passengerCount'] ?></td>
                                            <td><?php echo $flightRow['departureDatetime'] ?></td>
                                            <td><?php echo $flightRow['arrivalDatetime'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>
