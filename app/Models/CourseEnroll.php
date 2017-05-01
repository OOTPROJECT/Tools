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

        public function courseenrollByStudentID($student_id) {

            $this->table = "course_enroll";
            $course_enroll = CourseEnroll::where('student_id', '=', $student_id)->first();

            return $course_enroll;
        }

        function getAllCourseEnroll() {

            $this->table = "v_course_enroll";
            $arr_courseEnroll_list = CourseEnroll::orderBy('course_name','DESC')->get();
                                //    ->orderBy('created_at', 'DESC')->get();

            return $arr_courseEnroll_list;
        }

}
