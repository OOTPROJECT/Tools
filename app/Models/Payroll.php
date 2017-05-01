<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    // Table name
    protected $table = "payroll";
    protected $fillable = [
                          "course_schedule_id", "teacher_id", "hire", "status"
                        ];


    public function getPayrollByTeacherID($teacher_id) {

        $payroll = Payroll::where('teacher_id', '=', $teacher_id)->first();

        return $payroll;
    }

}
