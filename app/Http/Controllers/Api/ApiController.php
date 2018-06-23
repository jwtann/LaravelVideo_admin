<?php

namespace App\Http\Controllers\Api;

use App\Model\Lesson;
use App\Model\LessonTag;
use App\Model\Slider;
use App\Model\Tag;
use App\Model\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * 获取显示的轮播图数据接口
     * @return \Illuminate\Support\Collection
     */
    public function getSliders(){
        $sliders = Slider::where('is_show','=',1)->get();
        return $sliders;
    }

    /**
     * 获取所有标签数据接口
     * @return \Illuminate\Support\Collection
     */
    public function getTags(){
        return Tag::get();
    }

    /**
     * 获取所有课程数据接口
     * @return \Illuminate\Support\Collection
     */
    public function getAllLessons(){
        return Lesson::get();
    }

    /**
     * 获取推荐课程数据接口
     * @param int $num
     * @return \Illuminate\Support\Collection
     */
    public function getCommendLessons($num = 5){
        $commendlessons = Lesson::where('is_commend','=',1)->orderBy('id','DESC')->limit($num)->get();
        return $commendlessons;
    }

    /**
     * 获取某一个课程数据接口
     * @param $id
     * @return Lesson|mixed
     */
    public function getLesson($id){
        return Lesson::find($id);
    }

    /**
     * 获取某个课程对应视频数据接口
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function getVideos($id){
        return Video::where('lesson_id',$id)->get();
    }

    /**
     * 获得标签对应的课程数据接口
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function getTagLessons($id){
        if ($id){
            $tagLessons = LessonTag::where('tag_id',$id)->pluck('lesson_id');
            $lessons = Lesson::whereIn('id',$tagLessons)->get();
        }else{
            $lessons = Lesson::get();
        }
        return $lessons;
    }

    public function getHiddenSliders(){
        $sliders = Slider::where('is_show','=',0)->get();
        return $sliders;
    }









}












