<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM witness WHERE Witness_ID = $id";
$result = $conn->query($sql);
if ($result->num_rows != 1) {
    die("Witness not found.");
}
$witness = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $statement = $_POST['statement'];
    $crime_id = $_POST['crime_id'];

    $update_sql = "UPDATE witness SET 
                    Name='$name',
                    Contact_Information='$contact',
                    Statement='$statement',
                    Crime_ID=$crime_id
                   WHERE Witness_ID=$id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Witness updated successfully!</div>";
        echo "<script>setTimeout(function(){ window.location.href = 'view_witness.php'; }, 1500);</script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Witness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Edit Witness</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $witness['Name']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Contact Information</label>
            <input type="text" name="contact" class="form-control" value="<?php echo $witness['Contact_Information']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Statement</label>
            <textarea name="statement" class="form-control" required><?php echo $witness['Statement']; ?></textarea>
        </div>

        <div class="mb-3">
            <label>Crime</label>
            <select name="crime_id" class="form-select" required>
                <?php
                $crimes = $conn->query("SELECT * FROM crime");
                while($row = $crimes->fetch_assoc()) {
                    $selected = $row['Crime_ID'] == $witness['Crime_ID'] ? 'selected' : '';
                    echo "<option value='{$row['Crime_ID']}' $selected>{$row['Crime_Type']} (ID: {$row['Crime_ID']})</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update Witness</button>
        <a href="view_witness.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
