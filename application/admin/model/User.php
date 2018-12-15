<?php
namespace app\admin\model;
use think\Model;
class User extends Model{
    protected $pk="user_id";

    public function checkUser($username,$password){
        $where=[
            'username'=>$username,
            //'password'=>$password
            'password'=>md5($password.config('password_salt'))
        ];
        //halt($this);
        $userInfo=$this->where($where)->find();
        if($userInfo){
            session('username',$userInfo['username']);
            session('user_id',$userInfo['user_id']);
            return true;
        }else{
            return false;
        }
    }
}