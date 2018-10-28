<?php
/**
 * Created by PhpStorm.
 * User: vadim
 * Date: 27.10.18
 * Time: 19:55
 */

namespace app\controllers;


use app\models\Product;
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
            'randomProducts' => $randomProducts,
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
        if(count($products) >= Product::RANDOM_PRODUCTS_COUNT) {
            $random = array_rand($products, Product::RANDOM_PRODUCTS_COUNT);
            foreach ($random as $item) {
                $result[] = $products[$item];
            }
        }
        return $result;
    }

}