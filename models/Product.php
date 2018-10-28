<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "products".
 *
 * @property int $product_id
 * @property int $brand_id
 * @property string $name
 * @property string $description
 * @property int $rate
 * @property double $price
 *
 * @property CategoryProducts[] $categoryProducts
 * @property Comment[] $comments
 * @property Image[] $images
 * @property Brand $brand
 * @property string $shortDescription
 * @property string $mainImage
 * @property string $priceFormatted
 * @property ActiveQuery $category
 * @property int $commentsCount
 */
class Product extends \yii\db\ActiveRecord
{

    const DESCRIPTION_MAX_CHARS = 300;
    const RANDOM_PRODUCTS_COUNT = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brand_id', 'name', 'description', 'price'], 'required'],
            [['brand_id', 'rate'], 'integer'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 50],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::class, 'targetAttribute' => ['brand_id' => 'brand_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'brand_id' => 'Brand ID',
            'name' => 'Name',
            'description' => 'Description',
            'rate' => 'Rate',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryProducts()
    {
        return $this->hasMany(CategoryProducts::class, ['product_id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['product_id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::class, ['product_id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::class, ['brand_id' => 'brand_id']);
    }

    public function getShortDescription()
    {
        return mb_substr($this->description, 0, Product::DESCRIPTION_MAX_CHARS) . '...';
    }

    public function getMainImage()
    {
        if (isset($this->images[0])) {
            return '/images' . $this->images[0]->image_path;
        }
        return null;
    }

    public function getPriceFormatted()
    {
        return Yii::$app->formatter->asDecimal($this->price);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['category_id' => 'category_id'])->via('categoryProducts');
    }

    public function getCommentsCount()
    {
        return $this->getComments()->count();
    }


}
