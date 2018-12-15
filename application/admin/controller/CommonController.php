<?php
namespace app\admin\controller;
use think\Controller;
class CommonController extends Controller{
    /*public function __construct(){
        parent::__construct();
        if(!session('user_id')){
            $this->error('请登陆！',url('/admin/public/login'));
        }
    }*/

    public function _initialize(){
        if(!session('user_id')){
            $this->error('请先登陆',url('/admin/public/login'));
        }
    }
}
