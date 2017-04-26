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
}
