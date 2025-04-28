<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Officer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Add Officer</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Officer Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Badge Number</label>
            <input type="text" name="badge_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Rank</label>
            <input type="text" name="ranks" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Department</label>
            <input type="text" name="department" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contact Information</label>
            <input type="text" name="contact_information" class="form-control" required>
        </div>

        <button type="submit" name="add" class="btn btn-success">Add Officer</button>
        <a href="view_officer.php" class="btn btn-secondary">Back to List</a>
    </form>

    <?php
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $badge_number = $_POST['badge_number'];
        $ranks = $_POST['ranks'];
        $department = $_POST['department'];
        $contact_information = $_POST['contact_information'];

        $insert_sql = "INSERT INTO officer (Name, Badge_Number, Ranks, Department, Contact_Information)
                       VALUES ('$name', '$badge_number', '$ranks', '$department', '$contact_information')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "<div class='alert alert-success mt-3'>Officer added successfully!</div>";
            echo "<script>setTimeout(function(){ window.location.href = 'view_officer.php'; }, 1500);</script>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
        }
    }
    ?>
</div>
</body>
</html>
