<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$email = $argv[1];
$password = $argv[2];
$hash = password_hash($password, PASSWORD_ARGON2ID);

$sql = 'INSERT INTO users (email, password) VALUES (?, ?);';
$stetament = $pdo->prepare($sql);
$stetament->bindValue(1, $email);
$stetament->bindValue(2, $hash);
$stetament->execute();