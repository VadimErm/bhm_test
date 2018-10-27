<?php

use yii\helpers\Html;

/**
 * @var \app\models\Product $product
 */

?>

<div class="thumbnail">
    <?= Html::img($product->mainImage) ?>
    <div class="caption">
        <h3><?= $product->name ?></h3>
        <p><?= $product->shortDescription ?></p>
        <p>Цена: <?= $product->priceFormatted ?> грн.</p>
    </div>
</div>
