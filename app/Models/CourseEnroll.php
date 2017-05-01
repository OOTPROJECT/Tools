<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseEnroll extends Model
{
        protected $table = 'course_enroll';

        protected $fillable = ["course_schedule_id", "student_id"];


        function getcourseEnrollByCSId($cs_id) {

            $course_enroll = CourseEnroll::where('course_schedule_id', '=', $cs_id)
                                ->get();

            return $course_enroll;
        }

}
