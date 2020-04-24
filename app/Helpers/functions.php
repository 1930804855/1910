<?php 

 //无限极分类
    function createTree($data,$parent_id=0,$level=1){
        if(!$data){
            return;
        }
        static $newarray=[];
        foreach($data as $v){
            if($v->parent_id==$parent_id){
                $v->level=$level;
                $newarray[]=$v;
                createTree($data,$v->cate_id,$level+1);
            }
        }
        return $newarray;
    }

     //多文件上传
    function MoreUpload($filename){
        $file=request()->$filename;
        if(!is_array($file)){
            return;
        }
        foreach($file as $k=>$v){
            //实现上传
            $path[$k]=$v->store('uploads');
        }
        return $path;
        exit('上传出错');
    }

    //上传文件
    function upload($filename){
        //判断上传文件过程中是否出错
        if(request()->file($filename)->isValid()){
            //正确就接收文件
            $file=request()->$filename;
            //保存进入目录
            $path=$file->store('uploads');
            return $path;
        }
        exit('文件上传有误');
    }