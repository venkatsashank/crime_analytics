<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Witnesses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">All Witnesses</h2>
    <a href="add_witness.php" class="btn btn-primary mb-3">Add New Witness</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Witness ID</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Statement</th>
                <th>Crime</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT witness.*, crime.Crime_Type 
                    FROM witness
                    LEFT JOIN crime ON witness.Crime_ID = crime.Crime_ID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Witness_ID']}</td>
                            <td>{$row['Name']}</td>
                            <td>{$row['Contact_Information']}</td>
                            <td>{$row['Statement']}</td>
                            <td>{$row['Crime_Type']}</td>
                            <td>
                                <a href='edit_witness.php?id={$row['Witness_ID']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_witness.php?id={$row['Witness_ID']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?');\">Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No witnesses found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
