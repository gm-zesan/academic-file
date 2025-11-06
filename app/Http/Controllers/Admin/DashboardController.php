<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $course_count = 1;
        $student_count = 1;
        $teacher_count = 1;
        return view('admin.home.index', compact('course_count', 'student_count', 'teacher_count'));
    }
}
