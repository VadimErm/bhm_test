<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\HttpException;

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
        $category = Category::findOne(['category_id' => $id]);
        if($category === null) {
            throw new HttpException(404);
        }
        $products = $category->products;
        $categories = Category::find()->all();
        $mostCommented = $this->getMostCommented();
        return $this->render('products', [
            'categories' => $categories,
            'products' => $products,
            'mostCommented' => $mostCommented,
            'category' => $category
        ]);
    }

    private function getMostCommented()
    {
        $model = Product::find()
            ->select(new Expression('products.name, products.description, products.price, comments.product_id, count(*) as count'))
            ->leftJoin('comments', 'comments.product_id = products.product_id')
            ->groupBy('comments.product_id')
            ->orderBy('count DESC')
            ->limit(1)
            ->one();

        return $model;
    }
}