<?php

include 'Scripts/functions.php';
$db = new Database();
$conn = $db->conn;
session_start();
if ($_SERVER["REQUEST_METHOD"]=== "POST"){
    $username = $_POST["username"];
    $pass = $_POST["pass"];

    $process = new Processes ($conn);
    $process->login($username,$pass);
}
?>
