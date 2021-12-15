<?php
include "dbconnect.php";
session_start();

$room_id = $_POST['id'];
$user_id = $_SESSION['user_id'];
$_SESSION['room_id'] = $room_id;

$sql = "SELECT * FROM `rooms` WHERE room_id = :room_id";
$result = $conn->prepare($sql);
$result->execute(array(':room_id' => $room_id));

$row = $result->fetch();
if ($row['player_id'] == NULL){
    $sql = "UPDATE `rooms` SET player_id = :user_id WHERE room_id = :room_id";
    $update_result = $conn->prepare($sql);
    $update_result->execute(array(':user_id' => $user_id, ':room_id' => $room_id));
    echo(1);
}
else{
    echo(0);
}
?>