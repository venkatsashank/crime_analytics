<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM cases WHERE Case_ID = $id";
$result = $conn->query($sql);
if ($result->num_rows != 1) {
    die("Case not found.");
}
$case = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $crime_id = $_POST['crime_id'];
    $officer_id = $_POST['officer_id'];
    $status = $_POST['status'];
    $court_details = $_POST['court_details'];
    $outcome = $_POST['outcome'];

    $update_sql = "UPDATE cases SET 
                    Crime_ID=$crime_id,
                    Investigating_Officer_ID=$officer_id,
                    Status='$status',
                    Court_Details='$court_details',
                    Outcome='$outcome'
                   WHERE Case_ID=$id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Case updated successfully!</div>";
        echo "<script>setTimeout(function(){ window.location.href = 'view_cases.php'; }, 1500);</script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Case</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Edit Case</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Crime</label>
            <select name="crime_id" class="form-select" required>
                <?php
                $crimes = $conn->query("SELECT * FROM crime");
                while($row = $crimes->fetch_assoc()) {
                    $selected = $row['Crime_ID'] == $case['Crime_ID'] ? 'selected' : '';
                    echo "<option value='{$row['Crime_ID']}' $selected>{$row['Crime_Type']} (ID: {$row['Crime_ID']})</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Investigating Officer</label>
            <select name="officer_id" class="form-select" required>
                <?php
                $officers = $conn->query("SELECT * FROM officer");
                while($row = $officers->fetch_assoc()) {
                    $selected = $row['Officer_ID'] == $case['Investigating_Officer_ID'] ? 'selected' : '';
                    echo "<option value='{$row['Officer_ID']}' $selected>{$row['Name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <input type="text" name="status" class="form-control" value="<?php echo $case['Status']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Court Details</label>
            <textarea name="court_details" class="form-control" required><?php echo $case['Court_Details']; ?></textarea>
        </div>

        <div class="mb-3">
            <label>Outcome</label>
            <input type="text" name="outcome" class="form-control" value="<?php echo $case['Outcome']; ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update Case</button>
        <a href="view_cases.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
