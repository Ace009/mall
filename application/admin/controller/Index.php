<?php

namespace app\admin\controller;


class Index extends Common
{
    //后台首页
    function index()
    {
        $this->assign('title','后台管理首页');
        return view('index');
    }

}
