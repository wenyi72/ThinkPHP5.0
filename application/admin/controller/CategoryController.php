<?php
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Article;
class CategoryController extends CommonController{
    public function add(){
        //入库操作
		//1.判断是否是post请求
        if(request()->isPost()){
            //2.接受post参数
            $postDate=input('post.');
            //3.使用验证器进行验证
            $result=$this->validate($postDate,'Category.add',[],true);
            if($result!==true){
                $this->error(implode(',',$result));
            }
            //4.写入数据库
            $catModel=new Category();
            if($catModel->save($postDate)){
                //入库成功
                $this->success('入库成功',url('/admin/category/index'));

            }else{
                //入库失败
                $this->error('入库失败');
            }
        }

        //取出分类数据并分配到模板中去
        $catModel=new Category();
        $oldcats=$catModel->select()->toArray();
        //需要把$cats所有的分类进行无限极分类处理
        $cats=$catModel->getSonsCat($oldcats);
        //输出模板视图
        return $this->fetch('',[
            'cats'=>$cats
        ]);
    }

    public function index(){
        //取出所有的分类数据，分配到模板中
        $catModel=new Category();
        $oldCats=$catModel
                ->alias('t1')
                ->field('t1.*,t2.cat_name as p_name')
                ->join('tp_category t2','t1.pid=t2.cat_id','left')
                ->select();
                //经过无限极处理一下
        $cats=$catModel->getSonsCat($oldCats);
        return $this->fetch('',['cats'=>$cats]);
    }

    public function upd(){
        //入库操作
		//1.判断是否是post请求
        if(request()->isPost()){
            //2.接受post参数
            $postDate=input('post.');
            //3.使用验证器进行验证
            $result=$this->validate($postDate,'Category.upd',[],true);
            if($result!==true){
                $this->error(implode(',',$result));
            }
            //4.写入数据库
            $catModel=new Category();
            if($catModel->update($postDate)){
                //入库成功
                $this->success('编辑成功',url('/admin/category/index'));

            }else{
                //入库失败
                $this->error('编辑失败');
            }
        }

        //接受参数cat_id
       $cat_id=input('cat_id');
       $catModel=new Category();
       //取出cat_id对应的分类数据，分配模板中
       $catDate=$catModel->find($cat_id);
       //取出无限极分类的数据
       $oldCats=$catModel->select();
       $cats=$catModel->getSonsCat($oldCats);
       return $this->fetch('',[
           'catDate'=>$catDate,
           'cats'=>$cats
        ]);
    }

    public function ajaxdel(){
        $cat_id=input('cat_id');
        $catModel=new Category();
        $hasCat=$catModel->where("pid",'=',$cat_id)->find();
        if($hasCat){
            $response=['code'=>-1,'msg'=>'删除失败，当前分类下含有子类'];
            echo json_encode($response);
            exit;
        }
        $artModel=new Article();
        $hasArticle=$artModel->where("cat_id",'=',$cat_id)->find();
        if($hasArticle){
            $response=['code'=>-2,'msg'=>'删除失败，当前分类下含有文章'];
            echo json_encode($response);
            exit;
        }
        if(Category::destroy($cat_id)){
            $response=['code'=>200,'msg'=>'删除成功'];
            echo json_encode($response);
        }else{
            $response=['code'=>-3,'msg'=>'删除失败'];
            echo json_encode($response);
        }
    }
}