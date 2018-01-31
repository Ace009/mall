<?php

namespace app\admin\controller;


use think\Request;

class Brand extends Common
{
    //品牌列表页
    public function index(Request $request)
    {
        $map = null;
        $key = $request->param('key');
        $map['name'] = ['like',"%$key%"];
        $list = db('brand')->where($map)->paginate(1);
        $count = db('brand')->where($map)->count();
        $this->assign('count',$count);
        $this->assign('list',$list);
        $this->assign('key',$key);
        return view('index');
    }
    //添加品牌页面
    public function add(Request $request)
    {
        return view('add');
    }
    //修改页面
    public function edit(Request $request)
    {
        $id = $request->param('id');
        $data = db('brand')->find($id);
        $this->assign('data',$data);
        return view('edit');
    }

    //接收添加表单
    public function insert(Request $request)
    {

        if($request->isPost()){
            //初始返回数据
            $status = 0;
            $result = '';
            $data = $request->post();

            //验证规则
            $rules = [
                'name|品牌名' => 'require|max:50',
                'describe|描述' => 'max:255'
            ];

            $result = $this->validate($data,$rules);

            if($result === true){
                // 获取表单上传文件 例如上传了001.jpg
                $file = request()->file('logo');

                // 移动到框架应用根目录/public/uploads/ 目录下
                if($file){
                    $info = $file->validate(['size'=>51200,'ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public' . DS . 'uploads/brandLogo');
                    if($info){
                        // 成功上传后 获取上传信息
                        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                        $logo_path = '/uploads/brandLogo/'.$info->getSaveName();
                        $data['logo_path'] = $logo_path;
                    }else{
                        // 上传失败获取错误信息
                        $result = $file->getError();
                    }
                }
                if($result === true ){
                    //数据表添加数据
                    $return = db('brand')->insert($data);
                    if($return){
                        $status = 1;
                        $result = '添加成功';
                    }
                }
            }

            return json(['status'=>$status,'message'=>$result]);
        }
    }

    //接收修改表单
    public function update(Request $request)
    {
        if($request->isPost()){
            //初始返回数据
            $status = 0;
            $result = '';
            $data = $request->post();

            //验证规则
            $rules = [
                'name|品牌名' => 'require|max:50',
                'describe|描述' => 'max:255'
            ];

            $result = $this->validate($data,$rules);

            if($result === true){
                // 获取表单上传文件 例如上传了001.jpg
                $file = request()->file('logo');

                // 移动到框架应用根目录/public/uploads/ 目录下
                if($file){
                    $info = $file->validate(['size'=>51200,'ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public' . DS . 'uploads/brandLogo');
                    if($info){
                        // 成功上传后 获取上传信息
                        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                        $logo_path = '/uploads/brandLogo/'.$info->getSaveName();
                        $data['logo_path'] = $logo_path;
                    }else{
                        // 上传失败获取错误信息
                        $result = $file->getError();
                    }
                }
                if($result === true ){
                    //修改数据
                    $return = db('brand')->update($data);
                    if($return){
                        $status = 1;
                        $result = '修改成功';
                    }
                }
            }

            return json(['status'=>$status,'message'=>$result]);
        }
    }

    public function del(Request $request)
    {
        $id = $request->param('id');
        db('brand')->delete([$id]);
        return ['status'=>1];
    }
}
