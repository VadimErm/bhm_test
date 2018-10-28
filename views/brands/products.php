<?php

use kartik\sidenav\SideNav;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-md-3">
        <?= SideNav::widget([
            'encodeLabels' => false,
            'items' => $items
        ]) ?>
    </div>
    <div class="col-md-9">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <?= Html::a($this->render('/categories/partials/_product', ['product' => $product]), Url::to(['/product/index', 'id' => $product->product_id])) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
