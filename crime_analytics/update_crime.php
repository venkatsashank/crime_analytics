<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM crime WHERE Crime_ID = $id";
$result = $conn->query($sql);
if ($result->num_rows != 1) {
    die("Crime not found.");
}
$crime = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $crime_type = $_POST['crime_type'];
    $date_time = $_POST['date_time'];
    $location_id = $_POST['location_id'];
    $suspect_id = $_POST['suspect_id'];
    $victim_id = $_POST['victim_id'];
    $officer_id = $_POST['officer_id'];
    $status = $_POST['status'];

    $update_sql = "UPDATE crime SET 
                    Crime_Type='$crime_type',
                    Date_Time='$date_time',
                    Location_ID=$location_id,
                    Suspect_ID=$suspect_id,
                    Victim_ID=$victim_id,
                    Officer_ID=$officer_id,
                    Status='$status'
                   WHERE Crime_ID=$id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Crime updated successfully!</div>";
        echo "<script>setTimeout(function(){ window.location.href = 'view_crime.php'; }, 1500);</script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Crime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Edit Crime</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Crime Type</label>
            <input type="text" name="crime_type" class="form-control" value="<?php echo $crime['Crime_Type']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Date and Time</label>
            <input type="datetime-local" name="date_time" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($crime['Date_Time'])); ?>" required>
        </div>

        <div class="mb-3">
            <label>Location</label>
            <select name="location_id" class="form-select" required>
                <?php
                $locs = $conn->query("SELECT * FROM location");
                while($row = $locs->fetch_assoc()) {
                    $selected = $row['Location_ID'] == $crime['Location_ID'] ? 'selected' : '';
                    echo "<option value='{$row['Location_ID']}' $selected>{$row['Location_Name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Suspect</label>
            <select name="suspect_id" class="form-select" required>
                <?php
                $suspects = $conn->query("SELECT * FROM suspect");
                while($row = $suspects->fetch_assoc()) {
                    $selected = $row['Suspect_ID'] == $crime['Suspect_ID'] ? 'selected' : '';
                    echo "<option value='{$row['Suspect_ID']}' $selected>{$row['Suspect_Name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Victim</label>
            <select name="victim_id" class="form-select" required>
                <?php
                $victims = $conn->query("SELECT * FROM victim");
                while($row = $victims->fetch_assoc()) {
                    $selected = $row['Victim_ID'] == $crime['Victim_ID'] ? 'selected' : '';
                    echo "<option value='{$row['Victim_ID']}' $selected>{$row['Victim_Name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Officer</label>
            <select name="officer_id" class="form-select" required>
                <?php
                $officers = $conn->query("SELECT * FROM officer");
                while($row = $officers->fetch_assoc()) {
                    $selected = $row['Officer_ID'] == $crime['Officer_ID'] ? 'selected' : '';
                    echo "<option value='{$row['Officer_ID']}' $selected>{$row['Name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <input type="text" name="status" class="form-control" value="<?php echo $crime['Status']; ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update Crime</button>
        <a href="view_crime.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
