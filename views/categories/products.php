<?php

use app\widgets\categories\Categories;
use yii\helpers\Html;
use yii\helpers\Url;


/**
 * @var \app\models\Product[] $products
 */

?>

<div class="row">
    <div class="col-md-3">
        <?= Categories::widget([
            'categories' => $categories
        ]); ?>
    </div>
    <div class="col-md-9">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <?= Html::a($this->render('partials/_product', ['product' => $product]), Url::to(['/product/index', 'id' => $product->product_id])) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
