<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Victim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Add Victim</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Victim Name</label>
            <input type="text" name="victim_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-select" required>
                <option value="">Select Gender</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Address ID (from Location table)</label>
            <input type="number" name="address_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contact Information</label>
            <input type="text" name="contact_information" class="form-control" required>
        </div>

        <button type="submit" name="add" class="btn btn-success">Add Victim</button>
        <a href="view_victim.php" class="btn btn-secondary">Back to List</a>
    </form>

    <?php
    if (isset($_POST['add'])) {
        $victim_name = $_POST['victim_name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $address_id = $_POST['address_id'];
        $contact_information = $_POST['contact_information'];

        $insert_sql = "INSERT INTO victim (Victim_Name, Age, Gender, Address_ID, Contact_Information)
                       VALUES ('$victim_name', $age, '$gender', $address_id, '$contact_information')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "<div class='alert alert-success mt-3'>Victim added successfully!</div>";
            echo "<script>setTimeout(function(){ window.location.href = 'view_victim.php'; }, 1500);</script>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
        }
    }
    ?>
</div>
</body>
</html>
