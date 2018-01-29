<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//无限分类 获取tree结构数据
function getTree($data,$pid){
    $tree = '';
    foreach($data as $k=>$v){
        if($v['pid'] == $pid){
            $v['pid']= getTree($data,$v['id']);
            $tree[] = $v;
        }
    }
    return $tree;
}
