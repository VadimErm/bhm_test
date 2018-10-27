<?php

/** @var \app\models\Comment  $comment */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= $comment->user->user_name ?></h3>
    </div>
    <div class="panel-body">
        <?= $comment->comment_text ?>
    </div>
</div>

