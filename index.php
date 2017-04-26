<?php

require_once 'app/init.php';

$pageTitle = "Todo List";

$itemsQuery = $pdo->prepare("
    SELECT id, text, done
    FROM items
    WHERE user = :user
");

$itemsQuery->execute([
    'user' => $_SESSION['user_id']
]);

// PDO statement can only be looped once
// Use fetchAll instead
//$items = $itemsQuery->rowCount() ? $itemsQuery : [];
$items = $itemsQuery->fetchAll(PDO::FETCH_ASSOC);

$remaining = 0;
foreach ($items as $item) {
    if($item['done'] == 0) {
        $remaining++;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1><?= $pageTitle; ?></h1>

    <?php if(!empty($items)): ?>
        <span><?= $remaining; ?> of <?= $itemsQuery->rowCount(); ?> remaining</span> [ <a href="archive.php">archive</a> ]
        <ul class="items">
            <?php foreach ($items as $item): ?>
                <li>
                    <?php if(!$item['done']): ?>
                        <a href="tick.php?as=done&item=<?= $item['id']; ?>" class="done-tick"><i class="fa fa-square-o" aria-hidden="true"></i></a>
                    <?php else: ?>
                        <a href="tick.php?as=undone&item=<?= $item['id']; ?>" class="done-tick"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
                    <?php endif; ?>
                    <span class="done-<?= $item['done'] ? 'true' : 'false'; ?>"><?= $item['text']; ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No items are added yet.</p>
    <?php endif; ?>

    <form action="add.php" method="post">
        <input type="text" name="text" placeholder="add new todo here" autocomplete="off" required>
        <input type="submit" name="add" id="add" value="Add">
    </form>
</body>
</html>
