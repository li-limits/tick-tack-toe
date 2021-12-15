<?php
include "dbconnect.php";

$user_login = $_POST['new_login'];
$user_pass = $_POST['new_password'];

$hashpass = password_hash($user_pass, PASSWORD_DEFAULT);

$sql = "SELECT * FROM `users` WHERE login = :login";
$result = $conn->prepare($sql);
$result->execute(array(':login' => $user_login));
$row = $result->fetch();

if ($row) {
    echo("Такой логин уже занят!");
}
else {
    $sql = "INSERT INTO `users` (login, password) VALUES (:login, :password)";
    $result = $conn->prepare($sql);
    $result->execute(array(':login' => $user_login, ':password' => $hashpass));
    echo("Аккаунт успешно зарегистрирован!");
}
?>