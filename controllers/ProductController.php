<?php
/**
 * Created by PhpStorm.
 * User: vadim
 * Date: 27.10.18
 * Time: 19:55
 */

namespace app\controllers;


use app\models\Product;
use yii\db\Expression;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\HttpException;

class ProductController extends Controller
{
    public function actionIndex($id)
    {
        $model = Product::findOne(['product_id' => $id]);
        if($model === null) {
            throw new HttpException(404);
        }
        $randomProducts = $this->getRandomProducts($model);

        return $this->render('index', [
            'model' => $model,
            'randomProducts' => $randomProducts
            ]);
    }

    private function getRandomProducts(Product $product)
    {
        $result = [];
        $products = Product::find()
            ->joinWith('categoryProducts')
            ->where(['category_products.category_id' => $product->category->category_id])
            ->andWhere(['!=','products.product_id', $product->product_id])
            ->all();
        if(count($products) >= 2) {
            $random = array_rand($products, 2);
            $result[] = $products[$random[0]];
            $result[] = $products[$random[1]];
        } elseif (count($products) === 1) {
            $result[] = $products[0];
        }

        return $result;
    }

    public function actionMostCommented()
    {
        $model = Product::find()
            ->select(new Expression('products.name, products.description, products.price, comments.product_id, count(*) as count'))
            ->leftJoin('comments', 'comments.product_id = products.product_id')
            ->groupBy('comments.product_id')
            ->orderBy('count DESC')
            ->limit(1)
            ->one();


    }
}