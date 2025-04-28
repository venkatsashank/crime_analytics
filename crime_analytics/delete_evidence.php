<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

$delete_sql = "DELETE FROM evidence WHERE Evidence_ID = $id";

if ($conn->query($delete_sql) === TRUE) {
    header("Location: view_evidence.php");
    exit();
} else {
    echo "Error deleting evidence: " . $conn->error;
}
?>
