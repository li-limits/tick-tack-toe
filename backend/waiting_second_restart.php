<?php
session_start();
include 'dbconnect.php';

$room_id = $_SESSION['room_id'];

$sql = "SELECT * FROM `rooms` WHERE room_id = :room_id";
$result = $conn->prepare($sql);
$result->execute(array(':room_id' => $room_id));
$row = $result->fetch();

if ($row['restart_state'] == 1) {
    echo(1);
}
else if ($row['restart_state'] == 0) {
    echo(2);
}
?>