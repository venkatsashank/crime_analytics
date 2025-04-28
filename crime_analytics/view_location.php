<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Locations</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Location List</h2>
    <a href="add_location.php" class="btn btn-success mb-3">Add New Location</a>

    <?php
    $sql = "SELECT * FROM location";
    $result = $conn->query($sql);
    ?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Location ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Zip Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['Location_ID'] ?></td>
                        <td><?= $row['Location_Name'] ?></td>
                        <td><?= $row['Address'] ?></td>
                        <td><?= $row['City'] ?></td>
                        <td><?= $row['State'] ?></td>
                        <td><?= $row['Zip_Code'] ?></td>
                        <td>
                            <a href="update_location.php?id=<?= $row['Location_ID'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete_location.php?id=<?= $row['Location_ID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this location?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center">No locations found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>