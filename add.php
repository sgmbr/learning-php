<?php

require_once 'app/init.php';

if(isset($_POST['text'])) {
    $text = trim($_POST['text']);

    if(!empty($text)) {
        $addedQuery = $pdo->prepare("
            INSERT INTO items (text, user, done, created)
            VALUES (:text, :user, 0, NOW())
        ");

        $addedQuery->execute([
            'text' => $text,
            'user' => $_SESSION['user_id']
        ]);
    }
}

header('Location: index.php');
