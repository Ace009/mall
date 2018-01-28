<?php

namespace app\admin\controller;


class Category extends Common
{
    //添加商品分类
    public function categoryList()
    {
        $this->assign('title','商品分类');
        return view('product-category');
    }
    public function categoryAdd()
    {
        return view('product-category-add');
    }
}
