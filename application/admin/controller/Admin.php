<?php

namespace app\admin\controller;

class Admin extends Common
{
    //退出登录
    public function loginOut()
    {
        session(null);
        $this->success('退出成功,正在跳转……','login/index');
    }
}
