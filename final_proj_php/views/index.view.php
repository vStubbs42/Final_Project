<?php require_once "views/partials/header.php"; ?>
<h1>Welcome to <?= $siteName ?></h1>

<ul>
    <?php foreach ($boards as $board): ?>
            <li><?= $board->boardCode . " " .$board->location ?></li>
    <?php endforeach; ?>
</ul>


<?php require_once "views/partials/footer.php"; ?>

<?php //foreach ($tasks as $task): ?>
<!--    --><?php //if ($task->complete): ?>
<!--        <li><strike>--><?//= $task ?><!--</strike></li>-->
<!--    --><?php //else: ?>
<!--        <li>--><?//= $task ?><!--</li>-->
<!--    --><?php //endif; ?>
<?php //endforeach; ?>
