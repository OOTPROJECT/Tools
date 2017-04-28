<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Models\Students;
use App\Models\Teachers;
use App\Models\City;
use App\Models\Courses;
use App\Models\TimeTable;
use App\Models\Subjects;

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
        $this->city = new City();
        $this->teacher = new Teachers();
        $this->course = new Courses();
        $this->time_table = new TimeTable();
        $this->student = new Students();
        $this->subject = new Subjects();
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
            "firstname" => "required",
            "lastname" => "required",
            "nickname" => "required",
            "std_birthdate" => "required",
            "gender" => "required",
            "schoolname" => "required",
            "school_province_id" => "required",
            "school_level" => "required",
            "parent_fname" => "required",
            "parent_lname" => "required",
            "student_relationship" => "required",
            "parent_birthdate" => "required",
            "addr" => "required",
            "province_id" => "required",
            "district_id" => "required",
            "std_birthdate" => "required",
            "sub_district_id" => "required",
            "postcode" => "required",
            "email" => "required",
            "mobile" => "required",
            "tel" => "required",
            "parent_occupation" => "required",
          ],
          [

              "firstname.required" => "โปรดระบุ ชื่อนักเรียน",
              "lastname.required" => "โปรดระบุ นามสกุลนักเรียน",
              "nickname.required" => "โปรดระบุ ชื่อเล่นนักเรียน",
              "std_birthdate.required" => "โปรดระบุ วันเดือนปีเกิด",
              "gender.required" => "โปรดระบุ เพศนักเรียน",
              "schoolname.required" => "โปรดระบุ ชื่อโรงเรียนของนักเรียน",
              "school_province_id.required" => "โปรดระบุ จังหวัดของโรงเรียนนักเรียน",
              "school_level.required" => "โปรดระบุ ระดับชั้นเรียน",
              "parent_fname.required" => "โปรดระบุ ชื่อผู้ปกครอง",
              "parent_lname.required" => "โปรดระบุ นามสกุลผู้ปกครอง",
              "student_relationship.required" => "โปรดระบุ ความสัมพันธ์กับนักเรียน",
              "parent_birthdate.required" => "โปรดระบุ วันเกิดของผู้ปกครอง",
              "addr.required" => "โปรดระบุ บ้านเลขที่ของผู้ปกครอง",
              "province_id.required" => "โปรดระบุ จังหวัด",
              "district_id.required" => "โปรดระบุ เขต",
              "std_birthdate.required" => "โปรดระบุ วันเดือนปีเกิด",
              "sub_district_id.required" => "โปรดระบุ แขวง",
              "postcode.required" => "โปรดระบุ รหัสไปรษณีย์",
              "email.required" => "โปรดระบุ Email ",
              "mobile.required" => "โปรดระบุ เบอร์โทรศัพท์",
              "tel.required" => "โปรดระบุ เบอร์บ้าน",
              "parent_occupation.required" => "โปรดระบุ ตำแหน่ง",

        /*    "reg_date.required" => "โปรดระบุ วันที่สมัครเรียน",
            "std_username.required" => "โปรดระบุ ชื่อบัญชีผู้ใช้",
            "std_password.required" => "โปรดระบุ รหัสผ่าน 6 ตัวอักษร",
            "std_fname.required" => "โปรดระบุ ชื่อนักเรียน",
            "std_lname.required" => "โปรดระบุ นามสกุล",
            "std_nname.required" => "โปรดระบุ ชื่อเล่น",*/
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
        $prov = $this->city->getProvinces();
        $degree = array("1" => "ปริญญาตรี", "2" => "ปริญญาโท", "3" => "ปริญญาเอก");

        return view('teachers.teacher_reg')
                ->with('prov', $prov)
                ->with('degree_list', $degree);
    }

    /**
     * Show the application teacher information.
     *
     * @return \Illuminate\Http\Response
     */
    public function callTeacherInfoPage()
    {
        $allTeacher = $this->teacher->getAllTeacherInfo();
        return view('teachers.teacher_info')
            ->with('allTeacher', $allTeacher);
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
     * Create teacher info.
     *
     * @return \Illuminate\Http\Response
     */
     public function callTeacherEditPage($teacher_id)
     {
         $prov = $this->city->getProvinces();
         $degree = array("1" => "ปริญญาตรี", "2" => "ปริญญาโท", "3" => "ปริญญาเอก");

         return view('teachers.teacher_update')
                ->with('teacher_id', $teacher_id)
                 ->with('prov', $prov)
                 ->with('degree_list', $degree);
     }

     /**
      * Show the application teacher information.
      *
      * @return \Illuminate\Http\Response
      */
    public function createTeacher(Request $request)
    {
        $this->validate($request,
          [
            "firstname" => "required",
            "lastname" => "required",
            "birthdate" => "required|date",
            "personal_id" => "required",
            "gender" => "required",
            "email" => "required|email|between:3,100",
            "mobile" => "required",
            "tel" => "required",
            "home_no" => "required",
            "road_name" => "required",
            "province_id" => "required",
            "district_id" => "required",
            "sub_district_id" => "required",
            "postcode" => "required",
            "degree" => "required",
            "major" => "required",
            "university_name" => "required"
          ],
          [
            "firstname.required" => "โปรดระบุ ชื่อผู้สมัคร",
            "lastname.required" => "โปรดระบุ นามสกุลผู้สมัคร",
            "birthdate.required" => "โปรดระบุ วันเกิด",
            "personal_id.required" => "โปรดระบุ รหัสบัตรประชาชน",
            "gender.required" => "โปรดระบุ เพศ",
            "email.required" => "โปรดระบุ อีเมล์",
            "email.email" => "โปรดระบุ อีเมล์ ให้ถูกต้อง",
            "mobile.required" => "โปรดระบุ เบอร์โทรศัพท์มือถือ",
            "tel.required" => "โปรดระบุ เบอร์โทรศัพทบ้าน",
            "home_no.required" => "โปรดระบุ บ้านเลขที่",
            "road_name.required" => "โปรดระบุ ถนน",
            "province_id.required" => "โปรดระบุ จังหวัด",
            "district_id.required" => "โปรดระบุ อำเภอ",
            "sub_district_id.required" => "โปรดระบุ ตำบล",
            "postcode.required" => "โปรดระบุ รหัสไปรษณีย์",
            "degree.required" => "โปรดระบุ ระดับการศึกษา",
            "major.required" => "โปรดระบุ สาขาวิชา",
            "university_name.required" => "โปรดระบุ มหาวิทยาลัย",
          ]
        );

        // concat home number & road name as input_addr
        $input_addr = array(
                        "addr" => $request->input('home_no') . ", " .
                        $request->input('road_name')
                      );
        $input = $request->except('_token', 'home_no', 'road_name', 'province_list',
                    'district_list', 'sub_district_list');
        $input_teacher = array_merge($input, $input_addr);

        Teachers::create($input_teacher);
        Toastr::info("บันทึกข้อมูลการสอนพิเศษเรียบร้อยแล้ว");
        return back();
    }

    /**
     * Show the application classroom management.
     *
     * @return \Illuminate\Http\Response
     */
     public function updateTeacher(int $id ,Request $request)
     {
         $this->validate($request, [
             "firstname" => "required",
             "lastname" => "required",
             "image" => "required"
         ]);

         $teacher->update($request->all());
         Toastr::info("แก้ไขข้อมูลการสอนพิเศษเรียบร้อยแล้ว");
         return back();
     }

     /**
      * Show the application teacher information.
      *
      * @return \Illuminate\Http\Response
      */


    public function callClassMgtPage()
    {
        $all_course = $this->course->getCourse();
        $all_time_table = $this->time_table->getTimeTable();

        return view('classroom.class_mgt')
                ->with('all_course', $all_course)
                ->with('all_time_table', $all_time_table);
    }

    /**
     * Return districts data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDistricts(Request $request)
    {
        $dist = $this->city->getDistrictsByProvID(trim($request->prov_id));

        return $dist;
    }

    /**
     * Return sub districts data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubDistricts(Request $request)
    {
        $sub_dist = $this->city->getSubDistrictsByID(trim($request->prov_id),
                    trim($request->dist_id));

        return $sub_dist;
    }
    /**
     * Show the application student register.
     *
     * @return \Illuminate\Http\Response
     */
    public function callCourseEnrollPage()
    {
      $all_student = $this->student->getAllStudentInfo();
      $all_subject = $this->subject->getSubject();
        return view('course.course_enroll')
         ->with('all_student', $all_student)
         ->with('all_subject',$all_subject);

    }

}
