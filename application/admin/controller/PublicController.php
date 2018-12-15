<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;
use think\Validate;
//use think\Request;
class PublicController extends Controller{
    public function login(){
      //echo input('name','');
      /*input('name','','strtoupper');
      dump(input('post.'));
      dump(input('hobby/a'));*/

      //$res=Request::instance();//方式一
      //$res=request();//方式二,不加use think\Request不需要use Request所在的命名空间
      //halt($res);
      /*$user=[
        'username'=>'大锤',
        'age'=>125
      ];
      dump($user);*/

      //halt($res->param());

      if(request()->isPost()){
        $postDate=input('post.');

        $rule=[
          'username'=>'require|min:3',
          'password'=>'require',
          'captcha'=>'require|captcha'
        ];
        $message=[
          'username.require'=>'用户名必填',
          'username.min'=>'用户名长度最少为3位',
          'password.require'=>'密码必填',
          'captcha.require'=>'验证码不能为空',
          'captcha.captcha'=>'验证码错误'
        ];
        $validate=new Validate($rule,$message);
        $result=$validate->batch()->check($postDate);
        if(!$result){
          $this->error(implode(',',$validate->getError()));
        }

        $userModel=new User();
        $status=$userModel->checkUser($postDate['username'],$postDate['password']);
        if($status){
          //$this->redirect('/');
          $this->success('登陆成功！',url('/'));
        }else{
          $this->error('用户名或密码错误！');
        }
      }
		  return $this->fetch();
    }

    public function logout(){
      session(null);
      $this->redirect('/admin/public/login');
    }
}
