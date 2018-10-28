<?php

namespace app\widgets\categories;

use app\models\Category;
use yii\base\ErrorException;
use yii\helpers\Url;

class Categories extends \kartik\sidenav\SideNav
{
    public $categories;
    public $activeCategoryId;

    public function init()
    {
        $this->items = $this->formTree();
        $this->encodeLabels = false;
        parent::init();
    }

    public function formTree()
    {
        if($this->categories !== null) {
            $tree = [];
            $sub = [ null => &$tree ];
            /** @var Category $item */
            foreach ($this->categories as $item)
            {
                $id = $item->category_id;
                $name = $item->category_name;
                if($item->parent !== null) {
                    $parent = $item->parent->category_id;
                    $child = &$sub[$parent];
                    $child['items'][$id] = [
                        'label'=> '<span class="pull-right badge">' . $item->productTotalCount . '</span>' . $name,
                        'url' => Url::to(['/categories/category', 'id' => $id]),
                        'active' => ($id === $this->activeCategoryId)
                    ];
                    $sub[$id] = &$child['items'][$id];

                } else {
                    $parent = $item->parent;
                    $child = &$sub[$parent];
                    $child[$id] = [
                        'label'=> '<span class="pull-right badge">'. $item->productTotalCount .'</span>' . $name,
                        'url' => Url::to(['/categories/category', 'id' => $id]),
                        'active' => ($id === $this->activeCategoryId)
                    ];
                    $sub[$id] = &$child[$id];
                }
            }

            return $tree;
        }

        throw new ErrorException('Categories is null');
    }
}