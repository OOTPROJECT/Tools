<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {

    if (Auth::check()) {
        return redirect('/studentReg');
    }
    return view('auth.login');
});

// Register redirect page
Route::get('/home', function () {
    return redirect('/studentReg');
});

Route::auth();

// Student
Route::get('/studentReg', 'KingMathController@callStudentRegPage');
Route::get('/studentInfo', 'KingMathController@callStudentInfoPage');
Route::resource('student', 'KingMathController');

// Teacher
Route::get('/teacherReg', 'KingMathController@callTeacherRegPage');
Route::get('/teacherInfo', 'KingMathController@callTeacherInfoPage');
Route::get('/teachRec', 'KingMathController@callTeachRecPage');
Route::get('/teacherEdit/{teacher_id}', 'KingMathController@callTeacherEditPage');
Route::get('/HireCal', 'KingMathController@callHireCalPage');
Route::post('/createTeacher', 'KingMathController@createTeacher');
//Route::post('/updateTeacher/{teacher_id}', 'KingMathController@callTeacherUpdatePage');

// Classroom
Route::get('/ClassMgt', 'KingMathController@callClassMgtPage');

// City
Route::get('/districts', 'KingMathController@getDistricts');
Route::get('/sub_districts', 'KingMathController@getSubDistricts');
// Course Enroll
Route::get('/course_enroll','KingMathController@callCourseEnrollPage');
//Route::get('/course_enroll','KingMathController@getStudent');

Route::resource('profile', 'ProfileController');
Route::patch('profile/{profile}/password', 'ProfileController@update_password');
Route::resource('admin', 'AdminController');

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
