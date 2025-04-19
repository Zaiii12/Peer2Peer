<?php
require 'dbconnect.php';

$username = 'admin1';
$password = 'Password123';
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO admins (username, password_hash) VALUES (?, ?)");
$stmt->execute([$username, $hash]);

?>