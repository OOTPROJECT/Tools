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
        //$this->middleware('auth');
        $this->city = new City();
        $this->teacher = new Teachers();
        $this->course = new Courses();
        $this->time_table = new TimeTable();
        $this->course_schedule = new CourseSchedule();
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
            return view('students.student_info');
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



public function callStudentsinfoPage()
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

    return view('students.student_update')
    ->with('student_id', $student_id)
    ->with('student', $students)
    ->with('prov', $prov);




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
             "tel" => "required",
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
             "tel.required" => "โปรดระบุ เบอร์โทรศัพทบ้าน",
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
                     'district_list', 'sub_district_list', 'provid', 'distid', 'subdistid');
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
              $course_schedule = $this->teacher->courseScheduleByTeacherID($teacher_id);

              if(count($course_schedule) > 0) {
                  Toastr::info("ไม่สามารถลบครูผู้สอนได้ ");
                  //return array("resp" => false, "text" => "ไม่สามารถลบคลาสเรียนได้ เนื่องจากมีนักเรียนลงทะเบียนเรียน");
              }
              else {
                  $result = Teachers::where('teacher_id', '=', $teacher_id)->delete();

                  if($result == 1) {
                      Toastr::info("ลบข้อมูลครูผู้สอนเรียบร้อยแล้ว ");
                      //return array("resp" => true, "text" => "ลบข้อมูลครูผู้สอนเรียบร้อยแล้ว");
                  }
                  else {
                      Toastr::info("ไม่สามารถลบครูผู้สอนได้ ");
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
        $arr_course_schedule = $this->course_schedule->getAllCourseSchedule();

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
         $arr_time_table = $this->time_table->getTimeTable($start_date, $end_date, $room_name);

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
         $course_enroll = $this->course_schedule->courseEnrollByCSId($course_schedule_id);

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
