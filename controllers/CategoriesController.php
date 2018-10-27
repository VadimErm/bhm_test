<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use yii\db\Expression;
use yii\helpers\VarDumper;
use yii\web\Controller;

class CategoriesController extends Controller
{
    public function actionIndex()
    {
        $categories = Category::find()->all();
        return $this->render('index', [
            'categories' => $categories,
        ]);
    }

    public function actionCategory($id)
    {
        $products = Product::find()
            ->joinWith('categoryProducts')
            ->where(['category_products.category_id' => $id])
            ->all();
        $categories = Category::find()->all();
        return $this->render('products', [
            'categories' => $categories,
            'products' => $products
        ]);
    }
}