<?php
namespace app\admin\controller;
//use think\Controller;
class IndexController extends CommonController{
    public function page(){
		return 'admin/index/page';
    }

	public function index(){
		$arr=[
			['name'=>'一号','age'=>25],
			['name'=>'二号','age'=>18],
			['name'=>'三号','age'=>15],
		];
		return $this->fetch('',[
			'arr'=>$arr
		]);


	}

	public function index2(){
		return $this->fetch();
	}

	public function top(){
		return $this->fetch();
	}

	public function left(){
		return $this->fetch();
	}

	public function main(){
		return $this->fetch();
	}
}
