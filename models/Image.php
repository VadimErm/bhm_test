<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $image_id
 * @property int $product_id
 * @property string $image_path
 *
 * @property Product $product
 * @property string $imagePath
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'image_path'], 'required'],
            [['product_id'], 'integer'],
            [['image_path'], 'string', 'max' => 250],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'product_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'product_id' => 'Product ID',
            'image_path' => 'Image Path',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['product_id' => 'product_id']);
    }

    public function getImagePath()
    {
        return '/images' . $this->image_path;
    }
}
