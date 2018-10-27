<?php

namespace app\widgets\categories;

use app\models\Category;
use yii\helpers\Url;
use yii\helpers\VarDumper;

class Categories extends \kartik\sidenav\SideNav
{
    public $categories;

    public function init()
    {
        $this->items = $this->formTree($this->categories);
        $this->encodeLabels = false;
        parent::init();
    }


    public function formTree($catArray)
    {
        $tree = [];
        $sub = [ null => &$tree ];
        /** @var Category $item */
        foreach ($catArray as $item)
        {
            $id = $item->category_id;
            $name = $item->category_name;
            if($item->parent !== null) {
                $parent = $item->parent->category_id;
                $child = &$sub[$parent];
                $child['items'][$id] = ['label'=> '<span class="pull-right badge">' . $item->productTotalCount . '</span>' . $name, 'url' => Url::to(['/categories/category', 'id' => $id])];
                $sub[$id] = &$child['items'][$id];

            } else {
                $parent = $item->parent;
                $child = &$sub[$parent];
                $child[$id] = ['label'=> '<span class="pull-right badge">'. $item->productTotalCount .'</span>' . $name, 'url' => Url::to(['/categories/category', 'id' => $id])];
                $sub[$id] = &$child[$id];
            }
        }

        return $tree;

    }
}