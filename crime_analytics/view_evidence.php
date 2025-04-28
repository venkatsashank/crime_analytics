<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Evidence</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">All Evidence</h2>
    <a href="add_evidence.php" class="btn btn-primary mb-3">Add New Evidence</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Evidence ID</th>
                <th>Crime</th>
                <th>Type</th>
                <th>Description</th>
                <th>Collected By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT evidence.*, crime.Crime_Type, officer.Name AS Officer_Name
                    FROM evidence
                    LEFT JOIN crime ON evidence.Crime_ID = crime.Crime_ID
                    LEFT JOIN officer ON evidence.Collected_By = officer.Officer_ID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Evidence_ID']}</td>
                            <td>{$row['Crime_Type']}</td>
                            <td>{$row['Type']}</td>
                            <td>{$row['Description']}</td>
                            <td>{$row['Officer_Name']}</td>
                            <td>
                                <a href='edit_evidence.php?id={$row['Evidence_ID']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_evidence.php?id={$row['Evidence_ID']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?');\">Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No evidence found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
