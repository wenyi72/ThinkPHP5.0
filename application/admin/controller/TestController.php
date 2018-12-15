<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Category;
use app\admin\model\Article;
use think\Db;
class TestController extends Controller{
	public function test(){
		return $this->fetch();
	}

	public function db(){
		// 增：$model->save($data)
		// 删：Category::destroy('1,2,3')
		// 改：$model->update($data)
		// 查：
		// 单条：Category::get(1) Category::find(1), $model->get(1),$model->find()
		// 多条：Category::all() Category::select(), $model->all(),$model->select()

		// find和get的区别： find方法前面支持连贯操作，如where()

		// select和all的区别：select方法前面支持连贯操作，如where()

		$catModel=new Category();
		$where=[
			'cat_id'=>['>',6],
			'pid'=>['=',1]
		];
		//$data=$catModel->field("cat_id,cat_name")->where("cat_id",'>',6)->select()->toArray();
		$data=$catModel->order("cat_id desc")->where($where)->field("cat_id,cat_name")->select()->toArray();
		dump($data);
	}

	public function db2(){
		$date=[
			'title'=>'小罗伯特·唐尼',
			'cat_id'=>4,
			'article_id'=>5
		];
		$artModel=new Article();
		dump($artModel->update($date));

	}

	public function db3(){
		dump(Db::table("tp_article")->select());
	}
}