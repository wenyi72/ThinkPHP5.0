<?php
namespace app\admin\validate;
use think\Validate;
class Category extends Validate{
    //使用验证器进行验证
    //定义规则
    protected $rule=[
        'cat_name'=>'require|unique:category',
        'pid'=>'require'
    ];
    //定义提示信息
    protected $message=[
        'cat_name.require'=>'分类名称不能为空',
        'cat_name.unique'=>'分类名称已存在',
        'pid'=>'请选择一个分类'
    ];

    protected $scene=[
        //场景名=>场景验证对应的规则，规则是一维数组，验证元素多个规则用竖线'|'隔开
		//在add场景验证cat_name元素所有规则，验证pid元素的所有的规则
        'add'=>['cat_name','pid'],
        //在upd场景验证cat_name元素的require,验证pid元素的所有规则。
		//'upd' => ['cat_name'=>"require|unique:category",'pid'],
		//upd等价于下面
        'upd'=>['cat_name'=>"require",'pid']
    ];
}