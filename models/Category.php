<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the model class for table "categories".
 *
 * @property int $category_id
 * @property string $category_name
 * @property int $parent_category_id
 *
 * @property ActiveQuery $childCategories
 * @property ActiveQuery $parent
 * @property int $productTotalCount
 * @property int $productCount
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_name', 'parent_category_id'], 'required'],
            [['parent_category_id'], 'integer'],
            [['category_name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'parent_category_id' => 'Parent Category ID',
        ];
    }

    public function getChildCategories()
    {
        return $this->hasMany(Category::class, ['parent_category_id' => 'category_id']);
    }

    public function getParent()
    {
        return $this->hasOne(Category::class, ['category_id' => 'parent_category_id']);
    }

    public function getCategoryProducts()
    {
        return $this->hasMany(CategoryProducts::class, ['category_id' => 'category_id']);
    }

    public function getProductCount()
    {
       return $this->getCategoryProducts()->count();

    }

    public function getProductTotalCount()
    {
        $count = $this->getProductCount();
        $this->getCount($this->childCategories, $count);
        return $count;
    }

    private function getCount($categories, &$count)
    {
        /** @var Category $category */
        foreach ($categories as $category) {
           if(!empty($category->childCategories)) {
               $this->getCount($category->childCategories, $count);
           } else {
               $count += $category->productCount;
           }
       }
    }
}
