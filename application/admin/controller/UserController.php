<?php
namespace app\admin\controller;
use think\Controller;
class UserController extends Controller{
    public function login(){
            $name='ThinkPHP';
            $age='15';
            $users=[
                ['username'=>'飞机头','age'=>33],
                ['username'=>'鸡冠头','age'=>54],
                ['username'=>'菠萝头','age'=>18]
            ];

        return $this->fetch('',[
            'name'=>$name,
            'age'=>$age,
            'users'=>$users
        ]);
    }
}
