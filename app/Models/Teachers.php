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



}
