<?php

use yii\db\Migration;

/**
 * Class m181027_145050_add_foreing_keys
 */
class m181027_145050_add_foreing_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-categories-category_products',
            'category_products',
            'category_id',
            'categories',
            'category_id',
            'CASCADE'
            );

        $this->addForeignKey(
            'fk-products-category_products',
            'category_products',
            'product_id',
            'products',
            'product_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-products-images',
            'images',
            'product_id',
            'products',
            'product_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-products-brands',
            'products',
            'brand_id',
            'brands',
            'brand_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-comments-users',
            'comments',
            'user_id',
            'users',
            'user_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-comments-products',
            'comments',
            'product_id',
            'products',
            'product_id',
            'CASCADE'
        );




    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-comments-products', 'comments');
        $this->dropForeignKey('fk-comments-users', 'comments');
        $this->dropForeignKey('fk-products-brands', 'products');
        $this->dropForeignKey('fk-products-images', 'images');
        $this->dropForeignKey('fk-products-category_products', 'category_products');
        $this->dropForeignKey('fk-categories-category_products', 'category_products');
    }

}
