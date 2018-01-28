<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Admin extends Model
{
    //使用软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    //保存自动完成列表
    protected $auto = [
        'delete_time'   =>  null,
        'is_delete'     =>  0,
    ];
    //是否自动写入时间戳
    protected $autoWriteTimestamp = true;
    //创建时间字段
    protected $createTime = 'create_time';
    //更新时间字段
    protected $updateTime = 'update_time';




}
