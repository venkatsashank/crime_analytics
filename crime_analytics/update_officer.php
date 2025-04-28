<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM officer WHERE Officer_ID = $id";
$result = $conn->query($sql);
if ($result->num_rows != 1) {
    die("Officer not found.");
}
$officer = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $badge_number = $_POST['badge_number'];
    $ranks = $_POST['ranks'];
    $department = $_POST['department'];
    $contact_information = $_POST['contact_information'];

    $update_sql = "UPDATE officer SET 
                    Name='$name', 
                    Badge_Number='$badge_number', 
                    Ranks='$ranks', 
                    Department='$department', 
                    Contact_Information='$contact_information' 
                    WHERE Officer_ID=$id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Officer updated successfully!</div>";
        echo "<script>setTimeout(function(){ window.location.href = 'view_officer.php'; }, 1500);</script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Officer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Edit Officer</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Officer Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $officer['Name']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Badge Number</label>
            <input type="text" name="badge_number" class="form-control" value="<?php echo $officer['Badge_Number']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Rank</label>
            <input type="text" name="ranks" class="form-control" value="<?php echo $officer['Ranks']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Department</label>
            <input type="text" name="department" class="form-control" value="<?php echo $officer['Department']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Contact Information</label>
            <input type="text" name="contact_information" class="form-control" value="<?php echo $officer['Contact_Information']; ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update Officer</button>
        <a href="view_officer.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
