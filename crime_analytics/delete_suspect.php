<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

$delete_sql = "DELETE FROM suspect WHERE Suspect_ID = $id";

if ($conn->query($delete_sql) === TRUE) {
    header("Location: view_suspect.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
