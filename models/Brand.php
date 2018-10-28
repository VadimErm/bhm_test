<?php

namespace app\models;


/**
 * This is the model class for table "brands".
 *
 * @property int $brand_id
 * @property string $brand_name
 *
 * @property Product[] $products
 * @property int $commentsCount
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brand_name'], 'required'],
            [['brand_name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'brand_id' => 'Brand ID',
            'brand_name' => 'Brand Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['brand_id' => 'brand_id']);
    }

    public function getCommentsCount()
    {
        $count = 0;
        /** @var Product $product */
        foreach ($this->products as $product) {
           $count += $product->commentsCount;
       }
       return $count;
    }

}
