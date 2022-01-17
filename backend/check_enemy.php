<?php
session_start();
include 'dbconnect.php';

$user_id = $_SESSION['user_id'];
$room = $_SESSION['room_id'];

$sql = "SELECT * FROM `rooms` WHERE room_id = :room_id";
$result = $conn->prepare($sql);
$result->execute(array(':room_id' => $room));
$row = $result->fetch();

if ($user_id == $row['creator_id']) {
    $sql1 = "SELECT * FROM `users` WHERE user_id = :user_id";
    $result1 = $conn->prepare($sql1);
    $result1->execute(array(':user_id' => $row['player_id']));
    if ($row1 = $result1->fetch()) {
        echo($row1['login']);
    }
    else {
        echo("---");
    }
}
else if ($user_id == $row['player_id']) {
    $sql1 = "SELECT * FROM `users` WHERE user_id = :user_id";
    $result1 = $conn->prepare($sql1);
    $result1->execute(array(':user_id' => $row['creator_id']));
    if ($row1 = $result1->fetch()) {
        echo($row1['login']);
    }
    else {
        echo("---");
    }
}
?>