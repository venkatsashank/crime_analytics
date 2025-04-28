<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Suspects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">All Suspects</h2>
    <a href="add_suspect.php" class="btn btn-primary mb-3">Add New Suspect</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Suspect Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Criminal History</th>
                <th>Address ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM suspect";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Suspect_ID']}</td>
                            <td>{$row['Suspect_Name']}</td>
                            <td>{$row['Age']}</td>
                            <td>{$row['Gender']}</td>
                            <td>{$row['Criminal_History']}</td>
                            <td>{$row['Address_ID']}</td>
                            <td>
                                <a href='edit_suspect.php?id={$row['Suspect_ID']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_suspect.php?id={$row['Suspect_ID']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete?');\">Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No suspects found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
