<?php

use app\widgets\categories\Categories;

?>
<div class="row">
    <div class="col-md-3">
        <?= Categories::widget([
            'categories' => $categories
        ]); ?>
    </div>
</div>


