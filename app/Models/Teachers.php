<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teachers extends Model
{
    use SoftDeletes;

    // table name
    protected $table = 'teachers';
    protected $fillable = [
                          "firstname", "lastname", "birthdate", "personal_id",
                          "gender", "email", "mobile", "tel", "province_id",
                          "district_id", "sub_district_id","postcode",
                          "degree", "major", "university_name", "addr"
                        ];
    public $timestamps = ['created_at', 'updated_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
     protected $dates = ['deleted_at'];

     public function getAllTeacherInfo() {
         $all_teacher = Teachers::orderBy('firstname')->get();
         return $all_teacher;
     }

     public function getTeacherByID($teacher_id) {
         $teacher = new Teachers();
         $teacher = Teachers::where('teacher_id' , '=', $teacher_id)->first();

         return $teacher;
     }

     public function getAllTeacher() {
         $all_teacher = Teachers::where('deleted_at' , '=', null)->orderBy('firstname')->get();

         return $all_teacher;
     }

     public function getCourseEnrollByEnddate($current_month_year) {

         $course_enroll = \DB::select(
                            "SELECT teacher_id, firstname, lastname, course_schedule_id,
                            course_name, day, start_time, end_time, number_of_time,
                            start_date, end_date FROM v_course_schedule_payroll
                            WHERE CONCAT(YEAR(end_date), '-',
                            LPAD(MONTH(end_date), 2, '0')) = '" . $current_month_year .
                            "' AND status IS NULL"
                          );

        return $course_enroll;
     }

     public function getGender($gender){

         if ($gender == "F") {
             return "หญิง";
         }
         else {
             return "ชาย";
         }
     }

}
