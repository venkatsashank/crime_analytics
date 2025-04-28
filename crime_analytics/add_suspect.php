<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Suspect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Add Suspect</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Suspect Name</label>
            <input type="text" name="suspect_name" class="form-control" required>
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
            <label>Criminal History</label>
            <textarea name="criminal_history" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Address ID (from Location table)</label>
            <input type="number" name="address_id" class="form-control" required>
        </div>

        <button type="submit" name="add" class="btn btn-success">Add Suspect</button>
        <a href="view_suspect.php" class="btn btn-secondary">Back to List</a>
    </form>

    <?php
    if (isset($_POST['add'])) {
        $suspect_name = $_POST['suspect_name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $criminal_history = $_POST['criminal_history'];
        $address_id = $_POST['address_id'];

        $insert_sql = "INSERT INTO suspect (Suspect_Name, Age, Gender, Criminal_History, Address_ID)
                       VALUES ('$suspect_name', $age, '$gender', '$criminal_history', $address_id)";

        if ($conn->query($insert_sql) === TRUE) {
            echo "<div class='alert alert-success mt-3'>Suspect added successfully!</div>";
            echo "<script>setTimeout(function(){ window.location.href = 'view_suspect.php'; }, 1500);</script>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
        }
    }
    ?>
</div>
</body>
</html>
