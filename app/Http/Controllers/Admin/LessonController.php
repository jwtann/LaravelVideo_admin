<?php

namespace App\Http\Controllers\Admin;

use App\Model\Lesson;
use App\Model\LessonTag;
use App\Model\Tag;
use App\Model\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::paginate(10);
        return view('admin.lesson.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::get();
        return view('admin.lesson.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lesson = Lesson::create($request->all());

//        tags数据是一个数组，循坏获得每一个标签数据，存入lessontags表
        foreach ($request->input('tags') as $v){
            $lesson->lessonTag()->create([
                'tag_id' => $v,
            ]);
        }

        $videos = json_decode($request->input('videos'),true);
        foreach ($videos as $v){
            $lesson->videos()->create($v);
        }

        session()->flash('success','课程添加成功');
        return redirect()->route('lesson.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        $tags = Tag::get();
        $lessonTags = LessonTag::where('lesson_id',$lesson['id'])->pluck('tag_id')->toArray();
        $videos = json_encode($lesson->videos->toArray());
        return view('admin.lesson.edit',compact('lesson','tags','lessonTags','videos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
//        先将课程表的数据改成新的数据
        $lesson->title = $request->input('title');
        $lesson->introduce = $request->input('introduce');
        $lesson->thumb = $request->input('thumb');
        $lesson->is_commend = $request->input('is_commend');
        $lesson->is_hot = $request->input('is_hot');
        $lesson->click = $request->input('click');
        $lesson->save();

//        修改当前课程的标签数据
        LessonTag::where('lesson_id',$lesson['id'])->delete();
        foreach ($request->input('tags') as $v){
            $lesson->lessonTag()->create([
                'tag_id' => $v
            ]);
        }

        Video::where('lesson_id',$lesson['id'])->delete();
        $videos = json_decode($request->input('videos'),true);
        foreach ($videos as $v){
            $lesson->videos()->create($v);
        }

        session()->flash('success','课程修改成功!');
        return redirect()->route('lesson.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        LessonTag::where('lesson_id',$lesson['id'])->delete();
        Video::where('lesson_id',$lesson['id'])->delete();
        $lesson->delete();
        session()->flash('success','课程删除成功');
        return redirect()->route('lesson.index');
    }
}
