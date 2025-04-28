<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Court Trials</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Court Trials</h2>
    <a href="add_court_trial.php" class="btn btn-primary mb-3">Add New Trial</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Trial ID</th>
                <th>Case ID</th>
                <th>Judge</th>
                <th>Verdict</th>
                <th>Sentence</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM court_trial";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Trial_ID']}</td>
                            <td>{$row['Case_ID']}</td>
                            <td>{$row['Judge']}</td>
                            <td>{$row['Verdict']}</td>
                            <td>{$row['Sentence']}</td>
                            <td>
                                <a href='edit_court_trial.php?id={$row['Trial_ID']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_court_trial.php?id={$row['Trial_ID']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?');\">Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No court trials found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
