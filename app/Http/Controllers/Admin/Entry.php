<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Entry extends CommonController
{
    public function index(){
        return view('admin.entry.index');
    }
}
