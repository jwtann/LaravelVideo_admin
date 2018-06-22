<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = ['tags','videos'];

    public function lessonTag(){
        return $this->hasMany(LessonTag::class);
    }

    public function videos(){
        return $this->hasMany(Video::class);
    }
}
