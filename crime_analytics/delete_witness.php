<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

$delete_sql = "DELETE FROM witness WHERE Witness_ID = $id";

if ($conn->query($delete_sql) === TRUE) {
    header("Location: view_witness.php");
    exit();
} else {
    echo "Error deleting witness: " . $conn->error;
}
?>
