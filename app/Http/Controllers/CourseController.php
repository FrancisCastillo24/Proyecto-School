<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        // Aquí puedes pasar datos a la vista si quieres
        return view('user.course.index');
    }
}
