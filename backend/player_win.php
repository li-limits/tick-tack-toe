<?php
include 'dbconnect.php';

session_start();

$room_id = $_SESSION['room_id'];

$sql = "SELECT * FROM `rooms` WHERE room_id = :room_id";
$result = $conn->prepare($sql);
$result->execute(array(':room_id' => $room_id));
$row = $result->fetch();

$starter_id = $row['starter_id'];
$starter_sign = $row['starter_sign'];
$sign = $row['previous_sign'];

if ($row['changed_state'] == 1) {
    $sql = "UPDATE `rooms` SET changed_state = 0 WHERE room_id = :room_id";
    $result = $conn->prepare($sql);
    $result->execute(array(':room_id' => $room_id));
    exit();
}

$sql = "UPDATE `rooms` SET changed_state = 1 WHERE room_id = :room_id";
$result = $conn->prepare($sql);
$result->execute(array(':room_id' => $room_id));

if ($starter_sign == $sign) {
    if ($starter_id == 0) {
        $creator_wins = $row['creator_wins'] + 1;
        $sql = "UPDATE `rooms` SET starter_id = 1, creator_wins = :creator_wins, previous_sign = 'o' WHERE room_id = :room_id";
        $result = $conn->prepare($sql);
        $result->execute(array(':creator_wins' => $creator_wins, ':room_id' => $room_id));
    }
    else {
        $player_wins = $row['player_wins'] + 1;
        $sql = "UPDATE `rooms` SET starter_id = 0, player_wins = :player_wins, previous_sign = 'o' WHERE room_id = :room_id";
        $result = $conn->prepare($sql);
        $result->execute(array(':player_wins' => $player_wins, ':room_id' => $room_id));
    }
}
else {
    if ($starter_id == 0) {
        $player_wins = $row['player_wins'] + 1;
        $sql = "UPDATE `rooms` SET starter_id = 0, player_wins = :player_wins, previous_sign = 'o' WHERE room_id = :room_id";
        $result = $conn->prepare($sql);
        $result->execute(array(':player_wins' => $player_wins, ':room_id' => $room_id));
    }
    else {
        $creator_wins = $row['creator_wins'] + 1;
        $sql = "UPDATE `rooms` SET starter_id = 1, creator_wins = :creator_wins, previous_sign = 'o' WHERE room_id = :room_id";
        $result = $conn->prepare($sql);
        $result->execute(array(':creator_wins' => $creator_wins, ':room_id' => $room_id));
    }
}
?>