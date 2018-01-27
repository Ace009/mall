<?php

namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    //后台首页
    function index()
    {
        return view('index');
    }

}
