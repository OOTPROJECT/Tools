<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSchedule extends Model
{
    // Table name
    protected $table = "course_schedule";
    protected $fillable = [
                          "course_id", "teacher_id", "time_table_id", "start_date",
                          "end_date", "student_max", "status"
                        ];

    function getAllCourseSchedule() {

        $this->table = "v_course_schedule";
        $arr_course_schedule = CourseSchedule::select('course_name', 'day', 'start_time',
                                'end_time', 'firstname', 'lastname', 'room_name',
                                'start_date', 'end_date', 'course_hours', 'status',
                                'created_at')
                                ->orderBy('created_at', 'DESC')->get();

        return $arr_course_schedule;
    }
}
