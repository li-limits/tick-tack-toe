<?php
include "dbconnect.php";

session_start();

$room = $_POST['room_name'];
$pass = $_POST['room_password'];
$creator_id = $_SESSION['user_id'];

$starter_id = rand(0, 1);

$sql = "INSERT INTO `rooms` (creator_id, name, password, starter_id, starter_sign, user_turn, previous_sign) VALUES (:creator_id, :name, :password, :starter_id, 'x', :user_turn, 'o')";
$result = $conn->prepare($sql);
$result->execute(array(':creator_id' => $creator_id, ':name' => $room, ':password' => $pass, 'starter_id' => $starter_id, ':user_turn' => $starter_id));

$room_id = $conn->lastInsertId();
$_SESSION['room_id'] = $room_id;

$sql = "INSERT INTO `room_playboard_state` (room_id) VALUES (:room_id)";
$result = $conn->prepare($sql);
$result->execute(array(':room_id' => $room_id));

echo("Комната успешно создана!");
?>