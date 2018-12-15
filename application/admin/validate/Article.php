<?php
namespace app\admin\validate;
use think\Validate;
class Article extends Validate{

    protected $rule=[
        'title'=>'require|unique:article',
        'cat_id'=>'require'
    ];
    //定义提示信息
    protected $message=[
        'title.require'=>'文章标题不能为空',
        'title.unique'=>'文章标题已存在',
        'cat_id.require'=>'请选择一个分类'
    ];
    //验证场景
    protected $scene=[
        'add'=>['title','cat_id'],
        'upd'=>['title','cat_id']
    ];
}