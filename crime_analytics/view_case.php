<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Cases</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">All Cases</h2>
    <a href="add_case.php" class="btn btn-primary mb-3">Add New Case</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Case ID</th>
                <th>Crime</th>
                <th>Investigating Officer</th>
                <th>Status</th>
                <th>Court Details</th>
                <th>Outcome</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT cases.*, crime.Crime_Type, officer.Name AS Officer_Name
                    FROM cases
                    LEFT JOIN crime ON cases.Crime_ID = crime.Crime_ID
                    LEFT JOIN officer ON cases.Investigating_Officer_ID = officer.Officer_ID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Case_ID']}</td>
                            <td>{$row['Crime_Type']}</td>
                            <td>{$row['Officer_Name']}</td>
                            <td>{$row['Status']}</td>
                            <td>{$row['Court_Details']}</td>
                            <td>{$row['Outcome']}</td>
                            <td>
                                <a href='edit_case.php?id={$row['Case_ID']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_case.php?id={$row['Case_ID']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?');\">Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No cases found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
