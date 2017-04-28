<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseSchedule extends Model
{
    use SoftDeletes;

    // Table name
    protected $table = "course_schedule";
    protected $fillable = [
                          "course_id", "teacher_id", "time_table_id", "start_date",
                          "end_date", "student_max", "status"
                        ];
    protected $dates = ['deleted_at'];

    function getAllCourseSchedule() {

        $this->table = "v_course_schedule";
        $arr_course_schedule = CourseSchedule::select('course_schedule_id', 'course_name', 'day',
                                'start_time','end_time', 'firstname', 'lastname', 'room_name',
                                'start_date', 'end_date', 'course_hours', 'status',
                                'created_at')
                                ->orderBy('created_at', 'DESC')->get();

        return $arr_course_schedule;
    }

    function courseEnrollByCSId($course_schedule_id) {

        $this->table = "course_enroll";
        $course_enroll = CourseSchedule::where('course_schedule_id', '=', $course_schedule_id)
                            ->first();

        return $course_enroll;
    }
}