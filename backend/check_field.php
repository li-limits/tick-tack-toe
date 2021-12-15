<?php
include 'dbconnect.php';


$sql = "SELECT * FROM `room_playboard_state` WHERE room_id = :room_id";
$result = $conn->prepare($sql);
$result->execute(array())
for ($i = 0; $i <= 6; $i+=3){
    if ($_POST["html".($i + 1)] == $_POST["html".($i + 2)] && $_POST["html".($i + 2)] == $_POST["html".($i + 3)] && $_POST["html".($i + 2)] == 'x'){
        echo('x');
    }
    else if ($_POST["html".($i + 1)] == $_POST["html".($i + 2)] && $_POST["html".($i + 2)] == $_POST["html".($i + 3)] && $_POST["html".($i + 2)] == 'o'){
        echo('o');
    }
}
for ($i = 1; $i <= 3; $i+=1){
    if ($_POST["html".($i)] == $_POST["html".($i + 3)] && $_POST["html".($i + 3)] == $_POST["html".($i + 6)] && $_POST["html".($i + 3)] == 'x'){
        echo('x');
    }
    else if ($_POST["html".($i)] == $_POST["html".($i + 3)] && $_POST["html".($i + 3)] == $_POST["html".($i + 6)] && $_POST["html".($i + 3)] == 'o'){
        echo('o');
    }
}
if ($_POST["html1"] == $_POST["html5"] && $_POST["html5"] == $_POST["html9"] && $_POST["html5"] == 'x'){
    echo('x');
}
else if ($_POST["html1"] == $_POST["html5"] && $_POST["html5"] == $_POST["html9"] && $_POST["html5"] == 'o'){
    echo('o');
}
if ($_POST["html3"] == $_POST["html5"] && $_POST["html5"] == $_POST["html7"] && $_POST["html5"] == 'x'){
    echo('x');
}
else if ($_POST["html3"] == $_POST["html5"] && $_POST["html5"] == $_POST["html7"] && $_POST["html5"] == 'o'){
    echo('o');
}
?>