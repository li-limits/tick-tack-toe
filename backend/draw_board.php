<?php
include 'dbconnect.php';

session_start();

$room_id = $_SESSION['room_id'];

$sql = "SELECT * FROM `room_playboard_state` WHERE room_id = :room_id";
$result = $conn->prepare($sql);
$result->execute(array(':room_id' => $room_id));
$row = $result->fetch();

header("Content-Type: application/json; charset=utf-8", true);
echo json_encode(array('cell_1' => $row['cell_1'], 'cell_2' => $row['cell_2'], 'cell_3' => $row['cell_3'],
    'cell_4' => $row['cell_4'], 'cell_5' => $row['cell_5'], 'cell_6' => $row['cell_6'],
    'cell_7' => $row['cell_7'], 'cell_8' => $row['cell_8'], 'cell_9' => $row['cell_9']));
?>