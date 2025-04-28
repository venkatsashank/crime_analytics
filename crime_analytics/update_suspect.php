<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM suspect WHERE Suspect_ID = $id";
$result = $conn->query($sql);
if ($result->num_rows != 1) {
    die("Suspect not found.");
}
$suspect = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $suspect_name = $_POST['suspect_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $criminal_history = $_POST['criminal_history'];
    $address_id = $_POST['address_id'];

    $update_sql = "UPDATE suspect SET 
                    Suspect_Name='$suspect_name', 
                    Age=$age, 
                    Gender='$gender', 
                    Criminal_History='$criminal_history', 
                    Address_ID=$address_id 
                    WHERE Suspect_ID=$id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Suspect updated successfully!</div>";
        echo "<script>setTimeout(function(){ window.location.href = 'view_suspect.php'; }, 1500);</script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Suspect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Edit Suspect</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Suspect Name</label>
            <input type="text" name="suspect_name" class="form-control" value="<?php echo $suspect['Suspect_Name']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control" value="<?php echo $suspect['Age']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-select" required>
                <option <?php if($suspect['Gender']=='Male') echo 'selected'; ?>>Male</option>
                <option <?php if($suspect['Gender']=='Female') echo 'selected'; ?>>Female</option>
                <option <?php if($suspect['Gender']=='Other') echo 'selected'; ?>>Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Criminal History</label>
            <textarea name="criminal_history" class="form-control"><?php echo $suspect['Criminal_History']; ?></textarea>
        </div>

        <div class="mb-3">
            <label>Address ID</label>
            <input type="number" name="address_id" class="form-control" value="<?php echo $suspect['Address_ID']; ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update Suspect</button>
        <a href="view_suspect.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
