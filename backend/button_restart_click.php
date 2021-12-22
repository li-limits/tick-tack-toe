<?php
session_start();
include 'dbconnect.php';

$room_id = $_SESSION['room_id'];

$sql = "SELECT * FROM `rooms` WHERE room_id = :room_id";
$result = $conn->prepare($sql);
$result->execute(array(':room_id' => $room_id));
$row = $result->fetch();

if ($row['restart_state'] == 0) {
    $sql = "UPDATE `rooms` SET restart_state = 1 WHERE room_id = :room_id";
    $result = $conn->prepare($sql);
    $result->execute(array(':room_id' => $room_id));
    echo(1);
}
else if ($row['restart_state'] == 1) {
    $sql = "UPDATE `rooms` SET restart_state = 0 WHERE room_id = :room_id";
    $result = $conn->prepare($sql);
    $result->execute(array(':room_id' => $room_id));
    $sql = "UPDATE `room_playboard_state` SET cell_1 = NULL, cell_2 = NULL, cell_3 = NULL, cell_4 = NULL,
    cell_5 = NULL, cell_6 = NULL, cell_7 = NULL, cell_8 = NULL, cell_9 = NULL WHERE room_id = :room_id";
    $result = $conn->prepare($sql);
    $result->execute(array(':room_id' => $room_id));
    echo(2);
}
?>