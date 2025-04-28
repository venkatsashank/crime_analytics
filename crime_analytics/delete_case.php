<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

$delete_sql = "DELETE FROM cases WHERE Case_ID = $id";

if ($conn->query($delete_sql) === TRUE) {
    header("Location: view_cases.php");
    exit();
} else {
    echo "Error deleting case: " . $conn->error;
}
?>

