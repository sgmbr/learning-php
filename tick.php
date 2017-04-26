<?php

require_once 'app/init.php';

if(isset($_GET['as'], $_GET['item'])) {
    $as = $_GET['as'];
    $item = $_GET['item'];
    $done;

    switch($as) {
        case 'done':
            $done = 1;
        break;
        case 'undone':
            $done = 0;
        break;
        default:
            $done = 1;
        break;
    }

    $doneQuery = $pdo->prepare("
        UPDATE items
        SET done = $done
        WHERE id = :item
        AND user = :user
    ");

    $doneQuery->execute([
        'item' => $item,
        'user' => $_SESSION['user_id']
    ]);
}

header('Location: index.php');
