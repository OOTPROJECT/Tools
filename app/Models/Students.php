<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Students extends Model
{
    use SoftDeletes;

    // table name
    protected $table = 'students';
    protected $fillable = [
        "firstname"  ,
        "lastname"  ,
        "nickname"  ,
        "std_birthdate"  ,
        "gender"  ,
        "schoolname"  ,
        "school_province_id"  ,
        "school_level"  ,
        "parent_fname"  ,
        "parent_lname"  ,
        "student_relationship"  ,
        "parent_birthdate"  ,
        "addr"  ,
        "province_id"  ,
        "district_id"  ,
        "std_birthdate"  ,
        "sub_district_id"  ,
        "postcode"  ,
        "email"  ,
        "mobile"  ,
        "tel"  ,
        "parent_occupation"
                        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'std_password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function getAllStudentsInfo() {
        $all_Students = Students::orderBy('firstname')->get();
        return $all_Students;
    }

    public function getStudentByID($student_id) {
        $student = new student();
        $student = Students::where('student_id' , '=', $student_id)->first();

        return $student;
    }
    //get student info
    function getStudentInfo($firstname, $lastname) {
        $arr_student = Students::where('firstname','=', $firstname)
                        ->where('lastname','=', $lastname)->get();

        return $arr_student;
    }


        $this->table = "course_enroll";
        $course_enroll = CourseEnroll::where('student_id', '=', $student_id)->first();

        return $course_enroll;
    }


}
