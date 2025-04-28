<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Crime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Add New Crime</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Crime Type</label>
            <input type="text" name="crime_type" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Date and Time</label>
            <input type="datetime-local" name="date_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Location</label>
            <select name="location_id" class="form-select" required>
                <option value="">Select Location</option>
                <?php
                $locs = $conn->query("SELECT * FROM location");
                while($row = $locs->fetch_assoc()) {
                    echo "<option value='{$row['Location_ID']}'>{$row['Location_Name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Suspect</label>
            <select name="suspect_id" class="form-select" required>
                <option value="">Select Suspect</option>
                <?php
                $suspects = $conn->query("SELECT * FROM suspect");
                while($row = $suspects->fetch_assoc()) {
                    echo "<option value='{$row['Suspect_ID']}'>{$row['Suspect_Name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Victim</label>
            <select name="victim_id" class="form-select" required>
                <option value="">Select Victim</option>
                <?php
                $victims = $conn->query("SELECT * FROM victim");
                while($row = $victims->fetch_assoc()) {
                    echo "<option value='{$row['Victim_ID']}'>{$row['Victim_Name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Officer</label>
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

        <button type="submit" name="add" class="btn btn-success">Add Crime</button>
        <a href="view_crime.php" class="btn btn-secondary">Back to List</a>
    </form>

    <?php
    if (isset($_POST['add'])) {
        $crime_type = $_POST['crime_type'];
        $date_time = $_POST['date_time'];
        $location_id = $_POST['location_id'];
        $suspect_id = $_POST['suspect_id'];
        $victim_id = $_POST['victim_id'];
        $officer_id = $_POST['officer_id'];
        $status = $_POST['status'];

        $insert_sql = "INSERT INTO crime (Crime_Type, Date_Time, Location_ID, Suspect_ID, Victim_ID, Officer_ID, Status)
                       VALUES ('$crime_type', '$date_time', $location_id, $suspect_id, $victim_id, $officer_id, '$status')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "<div class='alert alert-success mt-3'>Crime added successfully!</div>";
            echo "<script>setTimeout(function(){ window.location.href = 'view_crime.php'; }, 1500);</script>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
        }
    }
    ?>
</div>
</body>
</html>
