<?php

namespace app\admin\controller;

use app\admin\model\Admin;
use think\Controller;
use think\Request;

class Login extends Controller
{
    //后台登录页面
    public function index()
    {
        $this->repeatLogin();
        return view('index');
    }

    //登录验证
    public function checkLogin(Request $request)
    {
        //初始化返回数据
        $status = 0;
        $result = '';
        $data = $request->param();

        //定义验证规则
        $rules = [
            'username|用户名'      =>  'require|min:3',
            'password|密码'    =>  'require|min:6',
            'verify|验证码'    =>  'require|captcha'
        ];
        //进行验证
        $result = $this->validate($data,$rules);

        if($result === true){
            //构造查询条件
            $map = [
                'username' => $data['username'],
                'password' => md5($data['password']),
            ];
            $user = Admin::get($map);
            if(empty($user)){
                $result = '用户名或密码错误';
            }else{
                //判断管理员状态
                if($user->status == '1'){
                    //记录登录次数
                    $user->where('id',$user->id)->setInc('login_count');
                    $user->where('id',$user->id)->update(['login_time'=>time()]);
                    //设置session 保存账号信息
                    session('admin_name',$user->username);
                    session('admin_info',$user->getData());
                    $status = 1;
                    $result = '登录成功,正在跳转!';
                }else{
                    $result = '该账号未启用,请联系超级管理员!';
                }
            }
        }
        return json(['status'=>$status,'message'=>$result]);
    }

    //防止重复登录
    public function repeatLogin()
    {
        if(session('admin_name')){
            $this->error('已经登录,勿重复登录!','index/index');
        }
    }

}
