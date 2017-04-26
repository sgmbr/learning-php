<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

session_start();
$_SESSION['user_id'] = 5;

/* local settings
$host = 'localhost';
$dbname = 'todo';
$user = 'root';
$pass = 'root';
*/

$host = 'us-cdbr-iron-east-03.cleardb.net';
$dbname = 'heroku_3344723f0824080';
$user = 'b86c900f759671';
$pass = 'ce394596';

$dsn = "mysql:host=$host;dbname=$dbname";

$pdo = new PDO($dsn, $user, $pass);
