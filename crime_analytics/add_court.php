<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Court Trial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Add Court Trial</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Case</label>
            <select name="case_id" class="form-select" required>
                <option value="">Select Case</option>
                <?php
                $cases = $conn->query("SELECT * FROM cases");
                while($row = $cases->fetch_assoc()) {
                    echo "<option value='{$row['Case_ID']}'>Case ID: {$row['Case_ID']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Judge</label>
            <input type="text" name="judge" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Verdict</label>
            <input type="text" name="verdict" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Sentence</label>
            <input type="text" name="sentence" class="form-control" required>
        </div>

        <button type="submit" name="add" class="btn btn-success">Add Court Trial</button>
        <a href="view_court_trial.php" class="btn btn-secondary">Back to List</a>
    </form>

    <?php
    if (isset($_POST['add'])) {
        $case_id = $_POST['case_id'];
        $judge = $_POST['judge'];
        $verdict = $_POST['verdict'];
        $sentence = $_POST['sentence'];

        $insert_sql = "INSERT INTO court_trial (Case_ID, Judge, Verdict, Sentence)
                       VALUES ($case_id, '$judge', '$verdict', '$sentence')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "<div class='alert alert-success mt-3'>Court Trial added successfully!</div>";
            echo "<script>setTimeout(function(){ window.location.href = 'view_court_trial.php'; }, 1500);</script>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
        }
    }
    ?>
</div>
</body>
</html>
