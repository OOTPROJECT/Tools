<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Models\Students;
use App\Models\Teachers;
use App\Models\City;
use App\Models\Courses;
use App\Models\TimeTable;
use App\Models\CourseSchedule;
use App\Models\Subjects;
use App\Models\Payroll;
use App\Models\CourseEnroll;
use DB;

class KingMathController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        // Authenticate user login
        $this->middleware('auth');

        $this->city = new City();
        $this->teacher = new Teachers();
        $this->course = new Courses();
        $this->time_table = new TimeTable();
        $this->course_schedule = new CourseSchedule();
        $this->student = new Students();
        $this->subject = new Subjects();
        $this->course_enroll = new CourseEnroll();
        $this->payroll = new Payroll();
    }



    /**
    * Show the application student register.
    *
    * @return \Illuminate\Http\Response
    */
    public function callStudentRegPage()
    {
        //return view('students.student_reg');
        $prov = $this->city->getProvinces();
        return view('students.student_reg')
        ->with('prov', $prov);
    }

    /**
    * Show the application student information.
    *
    * @return \Illuminate\Http\Response
    */
    public function callStudentInfoPage()
    {
            //return view('students.student_info');
      $allStudent = $this->students->getAllStudentInfo();
        return view('students.student_info')
        ->with('allStudent', $allStudent);


    }

    /**
    * Add student information.
    *
    * @return
    */
    public function createStudent(Request $request)
    {
        $this->validate($request,
        [
            "firstname" => "required|max:50",
            "lastname" => "required|max:50",
            "nickname" => "required|max:20",
            "std_birthdate" => "required|date",
            "gender" => "required",
            "schoolname" => "required|max:255",
            "school_province_id" => "required|numeric|min:1",
            "school_level" => "required",
            "parent_fname" => "required",
            "parent_lname" => "required",
            "student_relationship" => "required|max:10",
            "parent_birthdate" => "required|date",
            "addr" => "required",
            "province_id" => "required|numeric|min:1",
            "district_id" => "required|numeric|min:1",
            "std_birthdate" => "required|date",
            "sub_district_id" => "required|numeric|min:1",
            "postcode" => "required|digits_between:5,5",
            "email" => "required|required|email|between:3,100",
            "mobile" => "required|digits_between:10,10",
            "tel" => "required|digits_between:9,9",
            "parent_occupation" => "required|max:50",
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


        ]
    );

    $input_addr = array(
        "addr" => $request->input('addr') . ", " . $request->input('soi') . ", " .
        $request->input('road')
    );
    $input = $request->except('_token', 'addr','soi', 'road', 'province_list',
    'district_list', 'sub_district_list');
    $input_student = array_merge($input, $input_addr);


    Students::create($input_student);
    Toastr::info("บันทึกข้อมูลนักเรียนเรียบร้อยแล้ว");
    return back();
}

public function updateStudent($student_id ,Request $request)
{
    $this->validate($request,
    [
        "firstname" => "required|max:50",
        "lastname" => "required|max:50",
        "nickname" => "required|max:20",
        "std_birthdate" => "required|date",
        "gender" => "required",
        "schoolname" => "required|max:255",
        "school_province_id" => "required|numeric|min:1",
        "school_level" => "required",
        "parent_fname" => "required",
        "parent_lname" => "required",
        "student_relationship" => "required|max:10",
        "parent_birthdate" => "required|date",
        "addr" => "required",
        "province_id" => "required|numeric|min:1",
        "district_id" => "required|numeric|min:1",
        "std_birthdate" => "required|date",
        "sub_district_id" => "required|numeric|min:1",
        "postcode" => "required|digits_between:5,5",
        "email" => "required|required|email|between:3,100",
        "mobile" => "required|digits_between:10,10",
        "tel" => "required|digits_between:9,9",
        "parent_occupation" => "required|max:50",


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


    ]
);

    // concat home number & road name as input_addr
    $input_addr = array(
                    "addr" => $request->input('addr') . ", " . $request->input('soi') . ", " .
                    $request->input('road')
                  );
    $input = $request->except('_token', 'addr', 'soi','road', 'province_list',
                'district_list', 'sub_district_list', 'provid', 'distid', 'subdistid',
                'std_bd', 'parent_bd');

    $input_student = array_merge($input, $input_addr);



   Students::where('student_id', $student_id)->update($input_student);

   Toastr::info("แก้ไขข้อมูลนักเรียนเรียบร้อยแล้ว");
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



public function callStudentsInfoPage()
{
    $allStudents = $this->student->getAllStudentsInfo();
    return view('students.student_info')
    ->with('allStudents', $allStudents);
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
        $current_month_year = date("Y-m");
        $hiring_rate = 500;
        $arr_course_enroll = $this->teacher->getCourseEnrollByEnddate($current_month_year);

        return view('teachers.hire_cal')
                ->with('hiring_rate', $hiring_rate)
                ->with('arr_course_enroll', $arr_course_enroll)
                ->with('obj', new KingMathController);
    }

    public function calHire($number_of_times, $hiring_rate) {

        $hire = abs($number_of_times * $hiring_rate);

        return $hire;
    }

    public function createPayroll(Request $request) {

        $arr_data = array("status" => "จ่ายแล้ว");
        $input = $request->except('_token');
        $arr_payroll = array_merge($input, $arr_data);

        $resp = Payroll::create($arr_payroll)->saveOrFail();

        if($resp == 1) {

            return array("resp" => true, "text" => "บันทึการจ่ายเงินเรียบร้อยแล้ว");
        }
        else {

            return array("resp" => false, "text" => "ไม่สามารถการจ่ายเงินได้");
        }

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
    $teacher = $this->teacher->getTeacherByID($teacher_id);
    $address = explode(",", $teacher->addr);

    return view('teachers.teacher_update')
    ->with('teacher_id', $teacher_id)
    ->with('teacher', $teacher)
    ->with('address', $address)
    ->with('prov', $prov)
    ->with('degree_list', $degree);
}



public function callStudentEditPage($student_id)
{
    $prov = $this->city->getProvinces();
    $students = $this->student->getstudentByID($student_id);
    $address = explode(",", $students->addr);

    return view('students.student_update')
    ->with('student_id', $student_id)
    ->with('student', $students)
    ->with('prov', $prov)
    ->with('address', $address);
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
            "firstname" => "required|max:255",
            "lastname" => "required|max:255",
            "birthdate" => "required|date",
            "personal_id" => "required|digits_between:13,13",
            "gender" => "required",
            "email" => "required|email|between:3,100",
            "mobile" => "required|digits_between:10,10",
            // "tel" => "required|digits_between:9,9",
            "home_no" => "required",
            "province_id" => "required|numeric|min:1",
            "district_id" => "required|numeric|min:1",
            "sub_district_id" => "required|numeric|min:1",
            "postcode" => "required|digits_between:5,5",
            "degree" => "required",
            "major" => "required",
            "university_name" => "required"
          ],
          [
            "firstname.required" => "โปรดระบุ ชื่อผู้สมัคร",
            "lastname.required" => "โปรดระบุ นามสกุลผู้สมัคร",
            "birthdate.required" => "โปรดระบุ วันเกิด",
            "personal_id.required" => "โปรดระบุ รหัสบัตรประชาชน",
            "personal_id.digits_between" => "โปรดระบุ รหัสบัตรประชาชน ให้ถูกต้อง",
            "gender.required" => "โปรดระบุ เพศ",
            "email.required" => "โปรดระบุ อีเมล์",
            "email.email" => "โปรดระบุ อีเมล์ ให้ถูกต้อง",
            "mobile.required" => "โปรดระบุ เบอร์โทรศัพท์มือถือ",
            "mobile.digits_between" => "โปรดระบุ เบอร์โทรศัพท์มือถือ ให้ถูกต้อง",
            //"tel.required" => "โปรดระบุ เบอร์โทรศัพทบ้าน",
            "tel.digits_between" => "โปรดระบุ เบอร์โทรศัพท์บ้าน ให้ถูกต้อง",
            "home_no.required" => "โปรดระบุ บ้านเลขที่",
            "province_id.required" => "โปรดระบุ จังหวัด",
            "province_id.numeric" => "โปรดระบุ จังหวัด",
            "district_id.required" => "โปรดระบุ อำเภอ",
            "district_id.numeric" => "โปรดระบุ อำเภอ",
            "sub_district_id.required" => "โปรดระบุ ตำบล",
            "sub_district_id.numeric" => "โปรดระบุ ตำบล",
            "postcode.required" => "โปรดระบุ รหัสไปรษณีย์",
            "postcode.digits_between" => "โปรดระบุ รหัสไปรษณียให้ถูกต้อง",
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
        Toastr::info("บันทึกข้อมูลครูผู้สอนเรียบร้อยแล้ว");
        return back();
    }

    /**
     * Show the application classroom management.
     *
     * @return \Illuminate\Http\Response
     */
     public function updateTeacher($teacher_id ,Request $request)
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
            //  "tel" => "required",
             "home_no" => "required",
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
            //  "tel.required" => "โปรดระบุ เบอร์โทรศัพทบ้าน",
             "home_no.required" => "โปรดระบุ บ้านเลขที่",
             "province_id.required" => "โปรดระบุ จังหวัด",
             "district_id.required" => "โปรดระบุ อำเภอ",
             "sub_district_id.required" => "โปรดระบุ ตำบล",
             "postcode.required" => "โปรดระบุ รหัสไปรษณีย์",
             "postcode.postcode" => "โปรดระบุ รหัสไปรษณีย์เฉพาะตัวเลขเท่านั้น",
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
                     'district_list', 'sub_district_list', 'provid', 'distid', 'subdistid',
                     'bd');
         $input_teacher = array_merge($input, $input_addr);

         Teachers::where('teacher_id', $teacher_id)
                    ->update($input_teacher);

        Toastr::info("แก้ไขข้อมูลครูผู้สอนเรียบร้อยแล้ว");
        return back();
    }

     /**
      * Show the application teacher information.
      *
      * @return \Illuminate\Http\Response
      */
      public function deleteTeacher($teacher_id)
      {
          if ($teacher_id != null){
              $course_schedule = $this->course_schedule->courseScheduleByTeacherID($teacher_id);
              $payroll = $this->payroll->getPayrollByTeacherID($teacher_id);

              if(count($course_schedule) > 0 || count($payroll) > 0) {
                  Toastr::info("ไม่สามารถลบครูผู้สอนได้ ");
              }
              else {
                  $result = Teachers::where('teacher_id', '=', $teacher_id)->delete();

                  if($result == 1) {
                      Toastr::info("ลบข้อมูลครูผู้สอนเรียบร้อยแล้ว ");
                  }
                  else {
                      Toastr::info("ไม่สามารถลบครูผู้สอนได้ ");
                  }

              }
          }
          return back();

      }


      public function deleteStudent($student_id)
      {
          if ($student_id != null){
              $course_enroll = $this->course_enroll->courseEnrollByStudentID($student_id);

              if(count($course_enroll) > 0) {
                  Toastr::info("ไม่สามารถลบนักเรียนได้ ");
                  //return array("resp" => false, "text" => "ไม่สามารถลบคลาสเรียนได้ เนื่องจากมีนักเรียนลงทะเบียนเรียน");
              }
              else {
                  $result = Students::where('student_id', '=', $student_id)->delete();

                  if($result == 1) {
                      Toastr::info("ลบข้อมูลนักเรียนเรียบร้อยแล้ว ");
                      //return array("resp" => true, "text" => "ลบข้อมูลครูผู้สอนเรียบร้อยแล้ว");
                  }
                  else {
                      Toastr::info("ไม่สามารถลบนักเรียนได้ ");
                      //return array("resp" => false, "text" => "ไม่สามารถลบข้อมูลครูผู้สอนได้");
                  }

              }
          }
          return back();

      }







    /**
     * Show the application class management page.
     *
     * @return \Illuminate\Http\Response
     */

    public function callClassMgtPage()
    {
        $all_course = $this->course->getCourse();
        $all_classroom = $this->time_table->getAllClassRoom();
        $all_teacher = $this->teacher->getAllTeacher();
        $arr_course_schedule = $this->course_schedule->getAllCourseSchedule()
                                ->orderBy('created_at', 'DESC')->get();

        return view('classroom.class_mgt')
                ->with('all_course', $all_course)
                ->with('all_classroom', $all_classroom)
                ->with('all_teacher', $all_teacher)
                ->with('arr_course_schedule', $arr_course_schedule);
    }

    /**
     * Get time table & room information.
     *
     * @return \Illuminate\Http\Response
     */

     public function getTimeTable(Request $request)
     {
         $start_date = trim($request->input('start_date'));
         $end_date = trim($request->input('end_date'));
         $room_name = trim(str_replace('%20', ' ', $request->input('room_name')));
         $teacher_id = trim($request->input('teacher_id'));

         $arr_time_table = $this->time_table->getTimeTable($start_date, $end_date,
                            $teacher_id, $room_name);

         return $arr_time_table;
     }

    /**
     * Create course Schedule.
     *
     * @return \Illuminate\Http\Response
     */

    public function createCourseSchedule(Request $request)
    {

        $arr_data = array("student_max" => 10, "status" => "เปิด");
        // concat home number & road name as input_addr
        $input = $request->except('_token');
        $arr_course_schedule = array_merge($input, $arr_data);

        $resp = CourseSchedule::create($arr_course_schedule)->saveOrFail();

        if($resp == 1) {

            return array("resp" => true, "text" => "สร้างคลาสเรียนเรียบร้อยแล้ว");
        }
        else {

            return array("resp" => false, "text" => "ไม่สามารถสร้างคลาสเรียนได้");
        }
    }

    /**
     * Create course Schedule.
     *
     * @return \Illuminate\Http\Response
     */

     public function deleteCourseSchedule(Request $request) {
         $course_schedule_id = trim($request->input('cs_id'));
         $course_enroll = $this->course_enroll->courseEnrollByCSId($course_schedule_id);

         if(count($course_enroll) > 0) {
             return array("resp" => false, "text" => "ไม่สามารถลบคลาสเรียนได้ เนื่องจากมีนักเรียนลงทะเบียนเรียน");
         }
         else {
             $resp = CourseSchedule::where('course_schedule_id', '=', $course_schedule_id)->delete();

             if($resp == 1) {
                 return array("resp" => true, "text" => "ลบข้อมูลคลาสเรียนเรียบร้อยแล้ว");
             }
             else {
                 return array("resp" => false, "text" => "ไม่สามารถลบข้อมูลคลาสเรียนได้");
             }
         }
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
   * Show the application course enrollment.
   *
   * @return \Illuminate\Http\Response
   */
   public function callCourseEnrollPage()
   {

       $all_subject = $this->subject->getSubject();
       $arr_course_schedule = $this->course_schedule->getAllCourseSchedule()->where('status','=','เปิด')
                                ->orderBy('course_schedule_id','DESC')->get();
        $arr_courseEnroll_list=$this->course_enroll->getAllCourseEnroll();

       return view('course.course_enroll')
                ->with('all_subject',$all_subject)
                ->with('arr_course_schedule',$arr_course_schedule)
                ->with('arr_courseEnroll_list',$arr_courseEnroll_list);
    }
    /**
    * Show the get course schedule by subject.
    *
    * @return \Illuminate\Http\Response
    */
    public function getCourseBySubject(Request $request)
    {
        $subject_id = trim($request->input('subject_id'));
        $course_schedule_list = $this->course_schedule->getCourseBySubject($subject_id);
        return $course_schedule_list;

     }
     /**
     * Show the get student info by student name.
     *
     * @return \Illuminate\Http\Response
     */
     public function getStudentInfo(Request $request)
     {
         $firstname = trim($request->input('student_fname'));
         $lastname = trim($request->input('student_lname'));
         $studentinfo = $this->student->getStudentInfo($firstname, $lastname);
         return $studentinfo;

      }
      /**
       * Create Enrollment
       *
       * @return \Illuminate\Http\Response
       */
     public function createEnroll(Request $request)
     {

         $cs_id = trim($request->input('course_schedule_id'));
         $std_id = trim($request->input('student_id'));

         $input = $request->except('_token');
         $resp = CourseEnroll::create($input)->saveOrFail();

         $course_enroll = $this->course_enroll->getCourseEnrollByCSId($cs_id);
         $std_max = $this->course_schedule->getMaxByCSId($cs_id);
//echo count($course_enroll);
         if($resp == 1) {
             if(count($course_enroll) == $std_max->student_max){
                 //echo $std_max->student_max;
                  $chgStatus=CourseSchedule::where('course_schedule_id','=', $cs_id)
                             ->update(["status"=>"ปิด"]);
             }
             return array("resp" => true, "text" => "ลงทะเบียนเรียนเรียบร้อยแล้ว");

         }
         else {
             return array("resp" => false, "text" => "ไม่สามารถลงทะเบียนเรียนได้");
         }

     }

}
