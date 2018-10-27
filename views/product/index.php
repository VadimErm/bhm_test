<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var \app\models\Product $model */
?>

<div class="row">
    <div class="col-md-6">
        <?php foreach ($model->images as $image): ?>
            <div class="col-xs-6 col-md-3">
                <div class="thumbnail">
                    <?= Html::img($image->imagePath) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="col-md-6">
        <h2><?= $model->name ?></h2>
        <p><?= $model->description ?></p>
        <p>Цена: <?= $model->priceFormatted ?> грн.</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?php foreach ($randomProducts as $product) : ?>
            <div class="col-md-6">
                <?= Html::a($this->render('/categories/partials/_product', ['product' => $product]), Url::to(['/product/index', 'id' => $product->product_id])) ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="col-md-6">
        <?php foreach ($model->comments as $comment): ?>
            <?= $this->render('partials/_comment', ['comment' => $comment]) ?>
        <?php endforeach; ?>
    </div>
</div>

