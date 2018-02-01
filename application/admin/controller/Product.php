<?php

namespace app\admin\controller;

use think\Controller;

class Product extends Controller
{
    //产品列表
    public function index()
    {
        return view('index');
    }

    public function add()
    {
        return view('add');
    }
}
