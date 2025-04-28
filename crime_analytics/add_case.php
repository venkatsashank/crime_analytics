<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Case</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Add New Case</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Crime</label>
            <select name="crime_id" class="form-select" required>
                <option value="">Select Crime</option>
                <?php
                $crimes = $conn->query("SELECT * FROM crime");
                while($row = $crimes->fetch_assoc()) {
                    echo "<option value='{$row['Crime_ID']}'>{$row['Crime_Type']} (ID: {$row['Crime_ID']})</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Investigating Officer</label>
            <select name="officer_id" class="form-select" required>
                <option value="">Select Officer</option>
                <?php
                $officers = $conn->query("SELECT * FROM officer");
                while($row = $officers->fetch_assoc()) {
                    echo "<option value='{$row['Officer_ID']}'>{$row['Name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <input type="text" name="status" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Court Details</label>
            <textarea name="court_details" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Outcome</label>
            <input type="text" name="outcome" class="form-control" required>
        </div>

        <button type="submit" name="add" class="btn btn-success">Add Case</button>
        <a href="view_cases.php" class="btn btn-secondary">Back to List</a>
    </form>

    <?php
    if (isset($_POST['add'])) {
        $crime_id = $_POST['crime_id'];
        $officer_id = $_POST['officer_id'];
        $status = $_POST['status'];
        $court_details = $_POST['court_details'];
        $outcome = $_POST['outcome'];

        $insert_sql = "INSERT INTO cases (Crime_ID, Investigating_Officer_ID, Status, Court_Details, Outcome)
                       VALUES ($crime_id, $officer_id, '$status', '$court_details', '$outcome')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "<div class='alert alert-success mt-3'>Case added successfully!</div>";
            echo "<script>setTimeout(function(){ window.location.href = 'view_cases.php'; }, 1500);</script>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
        }
    }
    ?>
</div>
</body>
</html>
