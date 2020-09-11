<?php

require_once "views/about-culture.view.php"; ?>

<ul>
    <?php foreach ($boards as $board): ?>
            <li><?= $board->boardCode . " " .$board->location ?></li>
    <?php endforeach; ?>
</ul>