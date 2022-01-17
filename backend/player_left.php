<?php
include 'dbconnect.php';

session_start();

$user_id = $_SESSION['user_id'];
$room_id = $_SESSION['room_id'];

$sql = "SELECT * FROM `rooms` WHERE room_id = :room_id";
$result = $conn->prepare($sql);
$result->execute(array(':room_id' => $room_id));
$row = $result->fetch();

if ($user_id == $row['creator_id']){
    $sql = "DELETE FROM `rooms` WHERE room_id = :room_id";
    $result = $conn->prepare($sql);
    $result->execute(array(':room_id' => $room_id));
    echo('1');
}
else if ($user_id == $row['player_id']){
    $sql = "UPDATE `rooms` SET player_id = NULL, player_wins = 0 WHERE room_id = :room_id";
    $result = $conn->prepare($sql);
    $result->execute(array(':room_id' => $room_id));
    echo('2');
}
?>