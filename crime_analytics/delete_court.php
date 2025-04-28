<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

$delete_sql = "DELETE FROM court_trial WHERE Trial_ID = $id";

if ($conn->query($delete_sql) === TRUE) {
    header("Location: view_court_trial.php");
    exit();
} else {
    echo "Error deleting trial: " . $conn->error;
}
?>
