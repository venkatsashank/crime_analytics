<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Evidence</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Add New Evidence</h2>

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
            <label>Type</label>
            <input type="text" name="type" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Collected By (Officer)</label>
            <select name="collected_by" class="form-select" required>
                <option value="">Select Officer</option>
                <?php
                $officers = $conn->query("SELECT * FROM officer");
                while($row = $officers->fetch_assoc()) {
                    echo "<option value='{$row['Officer_ID']}'>{$row['Name']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="add" class="btn btn-success">Add Evidence</button>
        <a href="view_evidence.php" class="btn btn-secondary">Back to List</a>
    </form>

    <?php
    if (isset($_POST['add'])) {
        $crime_id = $_POST['crime_id'];
        $type = $_POST['type'];
        $description = $_POST['description'];
        $collected_by = $_POST['collected_by'];

        $insert_sql = "INSERT INTO evidence (Crime_ID, Type, Description, Collected_By)
                       VALUES ($crime_id, '$type', '$description', $collected_by)";

        if ($conn->query($insert_sql) === TRUE) {
            echo "<div class='alert alert-success mt-3'>Evidence added successfully!</div>";
            echo "<script>setTimeout(function(){ window.location.href = 'view_evidence.php'; }, 1500);</script>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
        }
    }
    ?>
</div>
</body>
</html>
