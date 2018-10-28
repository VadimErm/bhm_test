<?php

use app\widgets\categories\Categories;
use yii\helpers\Html;
use yii\helpers\Url;


/**
 * @var \app\models\Product[] $products
 * @var \app\models\Category $category
 * @var \app\models\Product $mostCommented
 * @var array $categories
 */

?>

<div class="row">
    <div class="col-md-3">
        <?= Categories::widget([
            'categories' => $categories,
            'activeCategoryId' => $category->category_id
        ]); ?>
        <div class="col-md-12">
            <?php if ($mostCommented !== null): ?>
                <h4>Это комментируют</h4>
                <?= Html::a($this->render('partials/_product', ['product' => $mostCommented]), Url::to(['/product/index', 'id' => $mostCommented->product_id])) ?>
                <?php foreach ($mostCommented->comments as $comment): ?>
                    <?= $this->render('/product/partials/_comment', ['comment' => $comment]) ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-9">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <?= Html::a($this->render('partials/_product', ['product' => $product]), Url::to(['/product/index', 'id' => $product->product_id])) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
