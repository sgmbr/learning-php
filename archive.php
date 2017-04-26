<?php

require_once 'app/init.php';

$archiveQuery = $pdo->prepare("
    DELETE FROM items
    WHERE user = :user
    AND done = 1
");

$archiveQuery->execute([
    'user' => $_SESSION['user_id']
]);

header('Location: index.php');
