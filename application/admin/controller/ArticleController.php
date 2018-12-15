<?php
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Article;
class ArticleController extends CommonController{
    public function ajaxGetContent(){
        if(request()->isAjax()){
            $article_id=input('article_id');
            $artModel=new Article();
            $content=$artModel->where("article_id",$article_id)->value('content');
            //echo json_encode(["content"=>$content]);
            return json(["content"=>$content]);
        }
    }

    public function add(){
        if(request()->isPost()){
            $postDate=input('post.');
            $result=$this->validate($postDate,'Article.add',[],true);
            if($result!==true){
                $this->error(implode(',',$result));
            }

            $ori_img=$this->uploadImg();
            $postDate['ori_img']=$ori_img;
            if($ori_img){
                $image=\think\Image::open("./upload/".$ori_img);
                $arr=explode('/',$ori_img);
                $thumb_img=$arr[0].'/thumb_'.$arr[1];
                $image->thumb(150,150,2)->save('./upload/'.$thumb_img);
                $postDate['thumb_img']=$thumb_img;
            }

            $artModel=new Article();
            if($artModel->allowField(true)->save($postDate,$postDate['ori_img'])){
                $this->success('入库成功',url('/admin/article/index'));
            }else{
                $this->error('入库失败');
            }
        }

        $catModel=new Category();
        $oldCats=$catModel->select();
        $cats=$catModel->getSonsCat($oldCats);
        return $this->fetch('',[
            'cats'=>$cats
        ]);
    }
    
    public function index(){
        $artsDate=Article::alias('t1')
                ->field('t1.*,t2.cat_name')
                ->join('tp_category t2','t1.cat_id=t2.cat_id','left')
                ->order('article_id desc')
                ->paginate(3);
        return $this->fetch('',['artsDate'=>$artsDate]);        
    }

    public function upd(){
        //入库操作
		//1.判断是否是post请求
        if(request()->isPost()){
            //2.接受post参数
            $postDate=input('post.');
            //halt($postDate);
            //3.使用验证器进行验证
            $result=$this->validate($postDate,'Article.upd',[],true);
            if($result!==true){
                $this->error(implode(',',$result));
            }
            //4.写入数据库
            $artModel=new Article();
            if($artModel->isUpdate(true)->allowField(true)->save($postDate)){
                $this->success('编辑成功',url('/admin/article/index'));
            }else{
                $this->error('编辑失败');
            }
            /*if($artModel->update($postDate,[],['title','content','cat_id'])){
                $this->success('编辑成功',url('/admin/article/index'));
            }else{
                $this->error('编辑失败');
            }*/
        }

       $article_id=input('article_id');
       $artModel=new Article();
       $catModel=new Category();
       $row=$artModel->find($article_id);
       $oldCats=$catModel->select();
       $cats=$catModel->getSonsCat($oldCats);
       return $this->fetch('',[
           'row'=>$row,
           'cats'=>$cats
        ]);
    }

    public function del(){
        $article_id=input('article_id');
        if(Article::destroy($article_id)){
            $this->success('删除成功',url('/admin/article/index'));
        }else{
            $this->error('删除失败');
        }
    }

    public function uploadImg(){
        if($file=request()->file('img')){
            if($file=request()->file('img')){
                $uploadDir='./upload';
                $validate=[
                    'size'=>1024*1024*3,
                    'ext'=>'jpg,png,gif,jpeg'
                ];
                $info=$file->validate($validate)->move($uploadDir);
                if($info){
                    $ori_img=$info->getSaveName();
                    return str_replace("\\",'/',$ori_img);
                }else{
                    $this->error($file->getError());
                }
            }
            return '';
        }
    }
}