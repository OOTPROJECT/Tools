<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutoringSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->increments('province_id');
            $table->string('province_name', 255);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->increments('district_id');
            $table->integer('province_id')->unsigned();
            $table->foreign('province_id')->references('province_id')->on('provinces');
            $table->string('district_name', 255);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sub_districts', function (Blueprint $table) {
            $table->increments('sub_district_id');
            $table->integer('province_id')->unsigned();
            $table->foreign('province_id')->references('province_id')->on('provinces');
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('district_id')->on('districts');
            $table->string('sub_district_name', 255);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->increments('student_id');
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->string('nickname', 20);
            $table->date('std_birthdate');
            $table->string('gender', 1);
            $table->string('schoolname', 255);
            $table->string('school_province_id', 3);
            $table->string('school_level', 1);
            $table->string('parent_fname', 50);
            $table->string('parent_lname', 50);
            $table->string('student_relationship', 10);
            $table->date('parent_birthdate');
            $table->string('addr', 255);
            $table->integer('province_id')->unsigned();
            $table->foreign('province_id')->references('province_id')->on('provinces');
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('district_id')->on('districts');
            $table->integer('sub_district_id')->unsigned();
            $table->foreign('sub_district_id')->references('sub_district_id')->on('sub_districts');
            $table->string('postcode', 5);
            $table->string('email', 100);
            $table->string('mobile', 10);
            $table->string('tel', 10);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('teacher_id');
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->date('birthdate');
            $table->string('gender', 1);
            $table->string('personal_id', 13);
            $table->string('addr', 255);
            $table->integer('province_id')->unsigned();
            $table->foreign('province_id')->references('province_id')->on('provinces');
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('district_id')->on('districts');
            $table->integer('sub_district_id')->unsigned();
            $table->foreign('sub_district_id')->references('sub_district_id')->on('sub_districts');
            $table->string('postcode', 5);
            $table->string('email', 100);
            $table->string('mobile', 10);
            $table->string('tel', 10);
            $table->string('university_name', 255);
            $table->string('degree', 255);
            $table->string('major', 255);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('subject_id');
            $table->string('subject_name', 255);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('time_table', function (Blueprint $table) {
            $table->increments('time_table_id');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('day');
            $table->string('room_no');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->increments('course_id');
            $table->integer('subject_id')->unsigned();
            $table->foreign('subject_id')->references('subject_id')->on('subjects');
            $table->string('course_name', 255);
            $table->integer('course_hours');
            $table->integer('price');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('course_schedule', function (Blueprint $table) {
            $table->increments('course_schedule_id');
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('course_id')->on('courses');
            $table->integer('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers');
            $table->integer('time_table_id')->unsigned();
            $table->foreign('time_table_id')->references('time_table_id')->on('time_table');
            $table->integer('student_max');
            $table->string('status', 10);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('course_enroll', function (Blueprint $table) {

            $table->increments('corse_enroll_id');
            $table->integer('course_schedule_id')->unsigned();
            $table->foreign('course_schedule_id')->references('course_schedule_id')->on('course_schedule');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('student_id')->on('students');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('payroll', function (Blueprint $table) {
            $table->increments('payroll_id');
            $table->integer('course_schedule_id')->unsigned();
            $table->foreign('course_schedule_id')->references('course_schedule_id')->on('course_schedule');
            $table->integer('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers');
            $table->integer('hire');
            $table->string('status', 10);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students');
        Schema::drop('teachers');
        Schema::drop('subjects');
        Schema::drop('time_table');
        Schema::drop('courses');
        Schema::drop('course_schedule');
        Schema::drop('course_enroll');
        Schema::drop('payroll');
        Schema::drop('provinces');
        Schema::drop('districts');
        Schema::drop('sub_districts');
    }
}
