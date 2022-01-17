<?php
session_start();
include 'dbconnect.php';

$room_id = $_SESSION['room_id'];

$sql = "SELECT * FROM `rooms` WHERE room_id = :room_id";
$result = $conn->prepare($sql);
$result->execute(array(':room_id' => $room_id));
$row = $result->fetch();

$sql1 = "SELECT * FROM `users` WHERE user_id = :user_id";
$result1 = $conn->prepare($sql1);
$result1->execute(array(':user_id' => $row['creator_id']));
$row_creator = $result1->fetch();

$sql2 = "SELECT * FROM `users` WHERE user_id = :user_id";
$result2 = $conn->prepare($sql2);
$result2->execute(array(':user_id' => $row['player_id']));
$row_player = $result2->fetch();

header("Content-Type: application/json; charset=utf-8", true);
echo json_encode(array('creator' => $row_creator['login'], 'player' => $row_player['login'], 
                        'creator_wins' => $row['creator_wins'], 'player_wins' => $row['player_wins']));
?>