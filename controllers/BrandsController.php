<?php
/**
 * Created by PhpStorm.
 * User: vadim
 * Date: 28.10.18
 * Time: 14:56
 */

namespace app\controllers;


use app\models\Brand;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;

class BrandsController extends Controller
{
    public function actionIndex()
    {
       $items = $this->renderItems();
       return $this->render('index', ['items' => $items]);
    }

    public function actionView($id)
    {
        $brand = Brand::findOne(['brand_id' => $id]);
        $items = $this->renderItems();
        if($brand === null) {
            throw new HttpException(404);
        }
        $products = $brand->products;
        return $this->render('products', ['products' => $products, 'items' => $items]);
    }

    private function renderItems()
    {
        $brands = Brand::find()->all();
        $items = [];
        /** @var Brand $brand */
        foreach ($brands as $brand) {
            $items[] = [
                'label' => $this->renderPartial('partials/_label', ['brand' => $brand]),
                'url' => Url::to(['/brands/view', 'id' => $brand->brand_id])
            ];
        }
        return $items;
    }

}