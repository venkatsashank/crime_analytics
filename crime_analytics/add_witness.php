<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Witness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Add New Witness</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contact Information</label>
            <input type="text" name="contact" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Statement</label>
            <textarea name="statement" class="form-control" required></textarea>
        </div>

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

        <button type="submit" name="add" class="btn btn-success">Add Witness</button>
        <a href="view_witness.php" class="btn btn-secondary">Back to List</a>
    </form>

    <?php
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $statement = $_POST['statement'];
        $crime_id = $_POST['crime_id'];

        $insert_sql = "INSERT INTO witness (Name, Contact_Information, Statement, Crime_ID)
                       VALUES ('$name', '$contact', '$statement', $crime_id)";

        if ($conn->query($insert_sql) === TRUE) {
            echo "<div class='alert alert-success mt-3'>Witness added successfully!</div>";
            echo "<script>setTimeout(function(){ window.location.href = 'view_witness.php'; }, 1500);</script>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
        }
    }
    ?>
</div>
</body>
</html>
