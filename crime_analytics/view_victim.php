<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Victims</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">All Victims</h2>
    <a href="add_victim.php" class="btn btn-primary mb-3">Add New Victim</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Victim Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Address ID</th>
                <th>Contact Info</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM victim";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Victim_ID']}</td>
                            <td>{$row['Victim_Name']}</td>
                            <td>{$row['Age']}</td>
                            <td>{$row['Gender']}</td>
                            <td>{$row['Address_ID']}</td>
                            <td>{$row['Contact_Information']}</td>
                            <td>
                                <a href='edit_victim.php?id={$row['Victim_ID']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_victim.php?id={$row['Victim_ID']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete?');\">Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No victims found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
