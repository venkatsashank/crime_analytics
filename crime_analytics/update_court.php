<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM court_trial WHERE Trial_ID = $id";
$result = $conn->query($sql);
if ($result->num_rows != 1) {
    die("Trial not found.");
}
$trial = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $case_id = $_POST['case_id'];
    $judge = $_POST['judge'];
    $verdict = $_POST['verdict'];
    $sentence = $_POST['sentence'];

    $update_sql = "UPDATE court_trial SET 
                    Case_ID = $case_id,
                    Judge = '$judge',
                    Verdict = '$verdict',
                    Sentence = '$sentence'
                   WHERE Trial_ID = $id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Court Trial updated successfully!</div>";
        echo "<script>setTimeout(function(){ window.location.href = 'view_court_trial.php'; }, 1500);</script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Court Trial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Edit Court Trial</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Case</label>
            <select name="case_id" class="form-select" required>
                <?php
                $cases = $conn->query("SELECT * FROM cases");
                while($row = $cases->fetch_assoc()) {
                    $selected = $row['Case_ID'] == $trial['Case_ID'] ? 'selected' : '';
                    echo "<option value='{$row['Case_ID']}' $selected>Case ID: {$row['Case_ID']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Judge</label>
            <input type="text" name="judge" class="form-control" value="<?php echo $trial['Judge']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Verdict</label>
            <input type="text" name="verdict" class="form-control" value="<?php echo $trial['Verdict']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Sentence</label>
            <input type="text" name="sentence" class="form-control" value="<?php echo $trial['Sentence']; ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update Trial</button>
        <a href="view_court_trial.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
