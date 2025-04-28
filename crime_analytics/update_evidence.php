<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM evidence WHERE Evidence_ID = $id";
$result = $conn->query($sql);
if ($result->num_rows != 1) {
    die("Evidence not found.");
}
$evidence = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $crime_id = $_POST['crime_id'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $collected_by = $_POST['collected_by'];

    $update_sql = "UPDATE evidence SET 
                    Crime_ID=$crime_id,
                    Type='$type',
                    Description='$description',
                    Collected_By=$collected_by
                   WHERE Evidence_ID=$id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Evidence updated successfully!</div>";
        echo "<script>setTimeout(function(){ window.location.href = 'view_evidence.php'; }, 1500);</script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Evidence</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Edit Evidence</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Crime</label>
            <select name="crime_id" class="form-select" required>
                <?php
                $crimes = $conn->query("SELECT * FROM crime");
                while($row = $crimes->fetch_assoc()) {
                    $selected = $row['Crime_ID'] == $evidence['Crime_ID'] ? 'selected' : '';
                    echo "<option value='{$row['Crime_ID']}' $selected>{$row['Crime_Type']} (ID: {$row['Crime_ID']})</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <input type="text" name="type" class="form-control" value="<?php echo $evidence['Type']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required><?php echo $evidence['Description']; ?></textarea>
        </div>

        <div class="mb-3">
            <label>Collected By</label>
            <select name="collected_by" class="form-select" required>
                <?php
                $officers = $conn->query("SELECT * FROM officer");
                while($row = $officers->fetch_assoc()) {
                    $selected = $row['Officer_ID'] == $evidence['Collected_By'] ? 'selected' : '';
                    echo "<option value='{$row['Officer_ID']}' $selected>{$row['Name']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update Evidence</button>
        <a href="view_evidence.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
