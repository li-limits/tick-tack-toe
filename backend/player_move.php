<?php
include "dbconnect.php";
session_start();

$cell_id = $_POST['id'];
$room_id = $_SESSION['room_id'];

$sql = "SELECT * FROM `rooms` WHERE room_id = :room_id";
$result = $conn->prepare($sql);
$result->execute(array(':room_id' => $room_id));
$row = $result->fetch();
$sign = NULL;
$user_turn = NULL;

if ($row['previous_sign'] == 'o'){
    $sign = 'x';
}
else {
    $sign = 'o';
}

if ($row['user_turn'] == 0){
    $user_turn = 1;
}
else {
    $user_turn = 0;
}

$sql = "UPDATE `rooms` SET previous_sign = :sign, user_turn = :user_turn WHERE room_id = :room_id";
$result = $conn->prepare($sql);
$result->execute(array(':sign' => $sign, ':user_turn' => $user_turn, ':room_id' => $room_id));

$sql = sprintf("UPDATE `room_playboard_state` SET %s = :sign WHERE room_id = :room_id", $cell_id);
$result = $conn->prepare($sql);
$result->execute(array(':sign' => $sign, ':room_id' => $room_id));

echo $sign;
?>