<?php
include '../db_connect.php';

if (isset($_GET['id'])) {
    $location_id = $_GET['id'];
    $sql = "DELETE FROM location WHERE Location_ID = $location_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Location deleted successfully!'); window.location.href='view_location.php';</script>";
    } else {
        echo "<script>alert('Error deleting location!'); window.location.href='view_location.php';</script>";
    }
} else {
    echo "<script>alert('Invalid Request!'); window.location.href='view_location.php';</script>";
}
?>