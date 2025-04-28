<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Crimes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">All Crimes</h2>
    <a href="add_crime.php" class="btn btn-primary mb-3">Add New Crime</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Crime ID</th>
                <th>Type</th>
                <th>Date Time</th>
                <th>Location</th>
                <th>Suspect</th>
                <th>Victim</th>
                <th>Officer</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT crime.*, 
                           location.Location_Name, 
                           suspect.Suspect_Name, 
                           victim.Victim_Name, 
                           officer.Name AS Officer_Name
                    FROM crime
                    LEFT JOIN location ON crime.Location_ID = location.Location_ID
                    LEFT JOIN suspect ON crime.Suspect_ID = suspect.Suspect_ID
                    LEFT JOIN victim ON crime.Victim_ID = victim.Victim_ID
                    LEFT JOIN officer ON crime.Officer_ID = officer.Officer_ID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Crime_ID']}</td>
                            <td>{$row['Crime_Type']}</td>
                            <td>{$row['Date_Time']}</td>
                            <td>{$row['Location_Name']}</td>
                            <td>{$row['Suspect_Name']}</td>
                            <td>{$row['Victim_Name']}</td>
                            <td>{$row['Officer_Name']}</td>
                            <td>{$row['Status']}</td>
                            <td>
                                <a href='edit_crime.php?id={$row['Crime_ID']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_crime.php?id={$row['Crime_ID']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?');\">Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No crimes found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
