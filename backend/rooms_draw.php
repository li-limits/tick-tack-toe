<?php
include "dbconnect.php";

$sql = "SELECT * FROM `rooms`";
$result = $conn->prepare($sql);
$result->execute();

$result_string = "";

while($row = $result->fetch()){
    $sql = "SELECT * FROM `users` WHERE user_id = :creator_id";
    $creator_sql = $conn->prepare($sql);
    $creator_sql->execute(array(':creator_id' => $row['creator_id']));
    $creator = $creator_sql->fetch();
    
    $result_string .= "<div class='room' id='room-".$row['room_id']."'>
                <div class='room_wrapper'>
                    <div class='room_unit_wrap'>
                        <span style='font-weight: 500; font-size: 20px;'>NAME:</br><span class='sapn_cl'>".$row['name']."</span></span>
                        <span style='font-weight: 500; font-size: 20px;'>CREATOR:</br><span class='sapn_cl'>".$creator['login']."</span></span>
                        <span style='font-weight: 500; font-size: 20px;'>PASSWORD: </br><span id='pass-".$row['room_id']."' class='sapn_cl'>";
            if ($row['password'] == NULL){
                $result_string .= "---";
            }
            else {
                $result_string .= "YES";
            }
            $result_string .="</span></span>
                    </div>
                </div>
            </div>";
    if ($row['password'] != NULL) {
        $result_string .= "<form class='room_pass_window' id='room_pass_window-".$row['room_id']."'>
                <b>Введите пароль!</b>
                <input type='text' name='pass' id='pass_input-".$row['room_id']."' required placeholder='Пароль..'></input>
                <input type='submit' placeholder='Войти'></input>
            </form>";
    }
}

echo($result_string);
?>