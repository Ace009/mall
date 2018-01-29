<?php

namespace app\admin\controller;


use think\Request;

class Category extends Common
{
    //商品分类列表
    public function categoryList()
    {
        $this->assign('title','商品分类');

        $list = db('category')->select();
        $data = getTree($list,0);
        $this->assign('categoryList',$data);


        return view('product-category');
    }
    //添加分类
    public function categoryAdd(Request $request)
    {
       if($request->isPost()){
           $status = 0;
           $result = '添加失败';
           $data['title'] = $request->param('title');
           $data['pid'] = $request->param('pid');

           $rules = [
               'title|分类名' => 'require'
           ];

           $result = $this->validate($data,$rules);
           if($result === true){
               $cate_id = db('category')->insert($data);
               if($cate_id){
                   $status = 1;
                   $result = '添加成功';
               }
           }

           return ['status'=>$status,'message'=>$result];
       }
       $this->assign('pid',$request->param('pid'));
       return view('product-category-add');
    }

    //编辑分类
    public function categoryEdit(Request $request)
    {
        $cate_id = $request->param('id');
        $cate_data = db('category')->find(['id'=>$cate_id]);
        $this->assign('data',$cate_data);

        if($request->isPost()){
            $status = 0;
            $result = '修改失败';
            $data = $request->post();
            if(db('category')->update($data)){
                $status = 1;
                $result = '修改成功';
            }
            return ['status'=>$status,'message'=>$result];
        }

        return view('product-category-edit');
    }

    //删除分类
    public function categoryDel(Request $request)
    {
        $cate_id = $request->param('id');
        db('category')->delete($cate_id);
    }

    public function test()
    {

    }





}
