<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

session_start();
$_SESSION['user_id'] = 5;

$host = 'localhost';
$dbname = 'todo';
$user = 'root';
$pass = 'root';

$dsn = "mysql:host=$host;dbname=$dbname";

$pdo = new PDO($dsn, $user, $pass);
