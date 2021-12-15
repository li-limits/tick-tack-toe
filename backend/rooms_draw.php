<?php
include "dbconnect.php";

$sql = "SELECT * FROM `rooms`";
$result = $conn->prepare($sql);
$result->execute();

while($row = $result->fetch()){
    $sql = "SELECT * FROM `users` WHERE user_id = :creator_id";
    $creator_sql = $conn->prepare($sql);
    $creator_sql->execute(array(':creator_id' => $row['creator_id']));
    $creator = $creator_sql->fetch();
    echo("<div class='room' id='room-".$row['room_id']."'>
            <a class='room_field'>".$row['name']."</a>
            <a class='room_field'>".$creator['login']."</a>
            <a class='room_field'>");
            if ($row['password'] == NULL){
                echo("Нет");
            }
            else {
                echo("Да");
            }
         echo("</a>
         </div>");
}
?>