<?php

use kartik\sidenav\SideNav;

?>

<div class="row">
    <div class="col-md-3">
        <?= SideNav::widget([
            'encodeLabels' => false,
            'items' => $items
        ]) ?>
    </div>
</div>
