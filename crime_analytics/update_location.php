<?php 
include 'db_connect.php'; 

// Check if id is set
if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = intval($_GET['id']); // sanitize ID

// Fetch data
$result = $conn->query("SELECT * FROM location WHERE Location_ID = $id");
if ($result->num_rows == 0) {
    die("Location not found.");
}
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Location</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Location</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label>Location Name</label>
            <input type="text" name="location_name" value="<?php echo htmlspecialchars($row['Location_Name']); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" required><?php echo htmlspecialchars($row['Address']); ?></textarea>
        </div>
        <div class="mb-3">
            <label>City</label>
            <input type="text" name="city" value="<?php echo htmlspecialchars($row['City']); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>State</label>
            <input type="text" name="state" value="<?php echo htmlspecialchars($row['State']); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Zip Code</label>
            <input type="text" name="zip_code" value="<?php echo htmlspecialchars($row['Zip_Code']); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Latitude</label>
            <input type="text" name="latitude" value="<?php echo htmlspecialchars($row['Latitude']); ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Longitude</label>
            <input type="text" name="longitude" value="<?php echo htmlspecialchars($row['Longitude']); ?>" class="form-control">
        </div>

        <button type="submit" name="update" class="btn btn-success">Update Location</button>
        <a href="view_location.php" class="btn btn-secondary">Cancel</a>
    </form>

<?php
// Handle update after form submit
if (isset($_POST['update'])) {
    $location_name = $conn->real_escape_string($_POST['location_name']);
    $address = $conn->real_escape_string($_POST['address']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $zip_code = $conn->real_escape_string($_POST['zip_code']);
    $latitude = $_POST['latitude'] !== '' ? floatval($_POST['latitude']) : null;
    $longitude = $_POST['longitude'] !== '' ? floatval($_POST['longitude']) : null;

    $update_sql = "UPDATE location SET 
                    Location_Name='$location_name',
                    Address='$address',
                    City='$city',
                    State='$state',
                    Zip_Code='$zip_code',
                    Latitude=" . ($latitude !== null ? $latitude : 'NULL') . ",
                    Longitude=" . ($longitude !== null ? $longitude : 'NULL') . "
                    WHERE Location_ID = $id";

    if ($conn->query($update_sql)) {
        echo "<div class='alert alert-success mt-3'>Location Updated Successfully!</div>";
        echo "<script>setTimeout(function(){ window.location.href = 'view_location.php'; }, 1500);</script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error updating: " . $conn->error . "</div>";
    }
}
?>
</div>
</body>
</html>
