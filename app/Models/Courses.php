<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    // table name
    protected $table = 'courses';

    function getCourse() {
        $all_course = Courses::orderBy('course_name')->get();

        return $all_course;
    }
}
