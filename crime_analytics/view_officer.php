<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Officers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">All Officers</h2>
    <a href="add_officer.php" class="btn btn-primary mb-3">Add New Officer</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Officer ID</th>
                <th>Name</th>
                <th>Badge Number</th>
                <th>Rank</th>
                <th>Department</th>
                <th>Contact Info</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM officer";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Officer_ID']}</td>
                            <td>{$row['Name']}</td>
                            <td>{$row['Badge_Number']}</td>
                            <td>{$row['Ranks']}</td>
                            <td>{$row['Department']}</td>
                            <td>{$row['Contact_Information']}</td>
                            <td>
                                <a href='edit_officer.php?id={$row['Officer_ID']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_officer.php?id={$row['Officer_ID']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete?');\">Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No officers found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
