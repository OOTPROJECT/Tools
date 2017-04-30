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
                                'start_time','end_time', 'firstname', 'lastname', 'room_name','price',
                                'start_date', 'end_date', 'number_of_time', 'status',
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

    function getCourseBySubject($subject_id) {

        $course_schedule = \DB::select(
                            "SELECT cs.course_schedule_id, c.course_name, tt.day, tt.start_time, tt.end_time
                            , t.firstname,tt.room_name,cs.start_date, cs.end_date, c.number_of_time, cs.status,c.price
                            FROM course_schedule AS cs
                            INNER JOIN courses AS c ON cs.course_id = c.course_id
                            INNER JOIN time_table AS tt ON cs.time_table_id = tt.time_table_id
                            INNER JOIN teachers AS t ON cs.teacher_id = t.teacher_id
                            WHERE c.subject_id = '". $subject_id ."'
                            ORDER BY cs.course_schedule_id "
                          );
        return $course_schedule;
    }
}
