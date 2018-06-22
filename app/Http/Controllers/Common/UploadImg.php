<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadImg extends Controller
{
    public function upload(Request $request){
        $file = $request->file;
        if ($file->isValid()){
            $path = $file->store(date('ymd',time()),'my_upload');
            return ['valid' => 1, 'message' => '/uploadImg/'.$path];
        }
        return ['valid' => 0, 'message' => '图片上传失败!'];
    }

    public function fileLists(){
        $files = glob('uploadImg/*/*');
        foreach ($files as $f) {
            $data[] = ['url' => "/".$f, 'path' => '/'.$f];
        }
//返回数据 data为文件列表 page 为分页数据，可以使用 houdunwang/page 组件生成
        return ['valid'=>1,'data' => $data,'page'=>[]];
    }
}
