<?php
namespace app\admin\model;
use think\Model;
class Category extends Model{
    //主键
    protected $pk="cat_id";
    //时间戳的自动维护
    protected $autoWriteTimestamp=true;
    // 时间字段取出后的默认时间格式(不转化时间格式)
    // protected $dateFormat = false;  

    //定义一个无限极分类的方法
    public function getSonsCat($date,$pid=0,$level=1){
        static $result=[];//定义一个静态变量,后面递归调用只会初始化一次
        foreach($date as $v){//第一次循环肯定是找到pid=0的元素
            if($v['pid']==$pid){
                $v['level']=$level;//给$v加一个下标level值为$level
                $result[]=$v; //把$v存进$result数组中
                $this->getSonsCat($date,$v['cat_id'],$level+1); //递归找子孙分类
            }
        }
        return $result;//返回递归的结果
    }
}