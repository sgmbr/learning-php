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
    <div class="container">
        <h1><?= $pageTitle; ?></h1>

        <?php if(!empty($items)): ?>
            <div class="summary"><?= $remaining; ?> of <?= $itemsQuery->rowCount(); ?> remaining <a href="archive.php"><button type="button" >archive</button></a></div>
            <ul class="items">
                <?php foreach ($items as $item): ?>
                    <li>
                        <?php if(!$item['done']): ?>
                            <a href="tick.php?as=done&item=<?= $item['id']; ?>" class="item">
                                <i class="fa fa-square-o tick" aria-hidden="true"></i>
                        <?php else: ?>
                            <a href="tick.php?as=undone&item=<?= $item['id']; ?>" class="item">
                                <i class="fa fa-check-square-o tick" aria-hidden="true"></i>
                        <?php endif; ?>
                                <span class="done-<?= $item['done'] ? 'true' : 'false'; ?>"><?= $item['text']; ?></span>
                            </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="empty">No items are added yet.</p>
        <?php endif; ?>

        <form action="add.php" method="post">
            <input type="text" name="text" placeholder="add new todo here" autocomplete="off" required>
            <input type="submit" name="add" id="add" value="Add">
        </form>
    </div>
</body>
</html>
