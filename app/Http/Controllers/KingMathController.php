<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Models\Students;

class KingMathController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application student register.
     *
     * @return \Illuminate\Http\Response
     */
    public function callStudentRegPage()
    {
        return view('students.student_reg');
    }

    /**
     * Show the application student information.
     *
     * @return \Illuminate\Http\Response
     */
    public function callStudentInfoPage()
    {
        return view('students.student_info');
    }

    /**
     * Add student information.
     *
     * @return
     */
    public function store(Request $request)
    {

        $this->validate($request,
          [
            "std_code" => "required",
            "reg_date" => "required",
            "std_username" => "required",
            "std_password" => "required",
            "std_fname" => "required",
            "std_lname" => "required",
            "std_nname" => "required",
          ],
          [
            "std_code.required" => "โปรดระบุ รหัสนักเรียน",
            "reg_date.required" => "โปรดระบุ วันที่สมัครเรียน",
            "std_username.required" => "โปรดระบุ ชื่อบัญชีผู้ใช้",
            "std_password.required" => "โปรดระบุ รหัสผ่าน 6 ตัวอักษร",
            "std_fname.required" => "โปรดระบุ ชื่อนักเรียน",
            "std_lname.required" => "โปรดระบุ นามสกุล",
            "std_nname.required" => "โปรดระบุ ชื่อเล่น",
          ]
        );


        Students::create($request->except('_token'));
        Toastr::info("บันทึกข้อมูลการสมัครเรียนเรียบร้อยแล้ว");
        return back();
    }

    /**
     * Show the application teacher register.
     *
     * @return \Illuminate\Http\Response
     */
    public function callTeacherRegPage()
    {
        return view('teachers.teacher_reg');
    }

    /**
     * Show the application teacher information.
     *
     * @return \Illuminate\Http\Response
     */
    public function callTeacherInfoPage()
    {
        return view('teachers.teacher_info');
    }

    /**
     * Show the application teach record.
     *
     * @return \Illuminate\Http\Response
     */
    public function callTeachRecPage()
    {
        return view('teachers.teach_rec');
    }

    /**
     * Show the application hire calculate.
     *
     * @return \Illuminate\Http\Response
     */
    public function callHireCalPage()
    {
        return view('teachers.hire_cal');
    }

    /**
     * Show the application classroom management.
     *
     * @return \Illuminate\Http\Response
     */
    public function callClassMgtPage()
    {
        return view('classroom.class_mgt');
    }
}
