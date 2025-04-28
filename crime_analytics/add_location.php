<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Location</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Location</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label>Location Name</label>
            <input type="text" name="location_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>City</label>
            <input type="text" name="city" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>State</label>
            <input type="text" name="state" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Zip Code</label>
            <input type="text" name="zip_code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Latitude</label>
            <input type="text" name="latitude" class="form-control">
        </div>
        <div class="mb-3">
            <label>Longitude</label>
            <input type="text" name="longitude" class="form-control">
        </div>

        <button type="submit" name="add" class="btn btn-success">Add Location</button>
        <a href="view_location.php" class="btn btn-secondary">View Locations</a>
    </form>

    <?php
    if (isset($_POST['add'])) {
        $location_name = $_POST['location_name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip_code = $_POST['zip_code'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];

        $insert = "INSERT INTO location (Location_Name, Address, City, State, Zip_Code, Latitude, Longitude)
                   VALUES ('$location_name', '$address', '$city', '$state', '$zip_code', '$latitude', '$longitude')";

        if ($conn->query($insert)) {
            echo "<div class='alert alert-success mt-3'>Location Added Successfully!</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
        }
    }
    ?>
</div>
</body>
</html>
