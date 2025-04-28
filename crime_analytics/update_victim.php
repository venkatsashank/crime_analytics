<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM victim WHERE Victim_ID = $id";
$result = $conn->query($sql);
if ($result->num_rows != 1) {
    die("Victim not found.");
}
$victim = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $victim_name = $_POST['victim_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address_id = $_POST['address_id'];
    $contact_information = $_POST['contact_information'];

    $update_sql = "UPDATE victim SET 
                    Victim_Name='$victim_name', 
                    Age=$age, 
                    Gender='$gender', 
                    Address_ID=$address_id, 
                    Contact_Information='$contact_information' 
                    WHERE Victim_ID=$id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Victim updated successfully!</div>";
        echo "<script>setTimeout(function(){ window.location.href = 'view_victim.php'; }, 1500);</script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Victim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Edit Victim</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Victim Name</label>
            <input type="text" name="victim_name" class="form-control" value="<?php echo $victim['Victim_Name']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control" value="<?php echo $victim['Age']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-select" required>
                <option <?php if($victim['Gender']=='Male') echo 'selected'; ?>>Male</option>
                <option <?php if($victim['Gender']=='Female') echo 'selected'; ?>>Female</option>
                <option <?php if($victim['Gender']=='Other') echo 'selected'; ?>>Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Address ID</label>
            <input type="number" name="address_id" class="form-control" value="<?php echo $victim['Address_ID']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Contact Information</label>
            <input type="text" name="contact_information" class="form-control" value="<?php echo $victim['Contact_Information']; ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update Victim</button>
        <a href="view_victim.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
