<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

$delete_sql = "DELETE FROM crime WHERE Crime_ID = $id";

if ($conn->query($delete_sql) === TRUE) {
    header("Location: view_crime.php");
    exit();
} else {
    echo "Error deleting crime: " . $conn->error;
}
?>
