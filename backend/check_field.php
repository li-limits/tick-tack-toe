<?php
include 'dbconnect.php';

session_start();

$room_id = $_SESSION['room_id'];

$sql = "SELECT * FROM `room_playboard_state` WHERE room_id = :room_id";
$result = $conn->prepare($sql);
$result->execute(array(':room_id' => $room_id));
$row = $result->fetch();

for ($i = 0; $i <= 6; $i+=3){
    if ($row["cell_".($i + 1)] == $row["cell_".($i + 2)] && $row["cell_".($i + 2)] == $row["cell_".($i + 3)] && $row["cell_".($i + 2)] == 'x'){
        echo('x');
    }
    else if ($row["cell_".($i + 1)] == $row["cell_".($i + 2)] && $row["cell_".($i + 2)] == $row["cell_".($i + 3)] && $row["cell_".($i + 2)] == 'o'){
        echo('o');
    }
}
for ($i = 1; $i <= 3; $i+=1){
    if ($row["cell_".($i)] == $row["cell_".($i + 3)] && $row["cell_".($i + 3)] == $row["cell_".($i + 6)] && $row["cell_".($i + 3)] == 'x'){
        echo('x');
    }
    else if ($row["cell_".($i)] == $row["cell_".($i + 3)] && $row["cell_".($i + 3)] == $row["cell_".($i + 6)] && $row["cell_".($i + 3)] == 'o'){
        echo('o');
    }
}
if ($row["cell_1"] == $row["cell_5"] && $row["cell_5"] == $row["cell_9"] && $row["cell_5"] == 'x'){
    echo('x');
}
else if ($row["cell_1"] == $row["cell_5"] && $row["cell_5"] == $row["cell_9"] && $row["cell_5"] == 'o'){
    echo('o');
}
if ($row["cell_3"] == $row["cell_5"] && $row["cell_5"] == $row["cell_7"] && $row["cell_5"] == 'x'){
    echo('x');
}
else if ($row["cell_3"] == $row["cell_5"] && $row["cell_5"] == $row["cell_7"] && $row["cell_5"] == 'o'){
    echo('o');
}
?>