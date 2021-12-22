<?php
include 'dbconnect.php';

session_start();

$sign = $_POST['sign'];
$room_id = $_SESSION['room_id'];

$sql = "SELECT * FROM `rooms` WHERE room_id = :room_id";
$result = $conn->prepare($sql);
$result->execute(array(':room_id' => $room_id));
$row = $result->fetch();

$starter_sign = $row['starter_sign'];

if ($starter_sign == $sign) {
    if ($starter_id == 0) {
        $creator_wins = $row['creator_wins'] + 1;
        $sql = "UPDATE `rooms` SET creator_wins = :creator_wins WHERE room_id = :room_id";
        $result = $conn->prepare($sql);
        $result->execute(array(':creator_wins' => $creator_wins, ':room_id' => $room_id));
        echo(0);
    }
    else {
        $player_wins = $row['player_wins'] + 1;
        $sql = "UPDATE `rooms` SET player_wins = :player_wins WHERE room_id = :room_id";
        $result = $conn->prepare($sql);
        $result->execute(array(':player_wins' => $player_wins, ':room_id' => $room_id));
        echo(1);
    }
}
else {
    if ($starter_id == 0) {
        $player_wins = $row['player_wins'] + 1;
        $sql = "UPDATE `rooms` SET player_wins = :player_wins WHERE room_id = :room_id";
        $result = $conn->prepare($sql);
        $result->execute(array(':player_wins' => $player_wins, ':room_id' => $room_id));
        echo(1);
    }
    else {
        $creator_wins = $row['creator_wins'] + 1;
        $sql = "UPDATE `rooms` SET creator_wins = :creator_wins WHERE room_id = :room_id";
        $result = $conn->prepare($sql);
        $result->execute(array(':creator_wins' => $creator_wins, ':room_id' => $room_id));
        echo(0);
    }
}
?>