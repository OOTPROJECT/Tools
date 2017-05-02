@extends('layouts.app')


@section('htmlheader_title')
การซื้อคอร์ส
@endsection

@section('contentheader_title')
การซื้อคอร์ส
@endsection

@section('main-content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div>

    <!---ข้อมูลนักเรียน-->
    <div class="box-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#buyCourse" aria-controls="home" role="tab" data-toggle="tab">ซื้อคอร์ส</a></li>
          <li role="presentation"><a href="#courseInfo" aria-controls="profile" role="tab" data-toggle="tab">รายการคอร์ส</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="buyCourse"></br>
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title">เลือกนักเรียน</h3>
                  </div>
                  <!--check error-->
                  <div class="panel-body">

                      {!! csrf_field() !!}
                      @if(count($errors))
                      <div class="alert alert-danger">
                          <strong>Whoops!</strong> There were some problems with your input.
                          <br/>
                          <ul>
                              @foreach($errors->all() as $error)
                              <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                      @endif
                      <div id="student">
                          <div class="panel-heading">
                              <h3 class="panel-title">ค้นหานักเรียน</h3>
                          </div>
                          <div class="row">
                              <span class="col-sm-2 col-md-1 text-right">ชื่อ:</span>
                                  <div class="col-sm-2 col-md-2 text-left">
                                      <input type="text" id="std_fname" name="std_fname"><br>
                                      <span id="span-name"class="text-right" style="display:none; color:red">กรุณาระบุชื่อ</span>
                                  </div>
                              <span class="col-sm-2 col-md-1 text-right">นามสกุล:</span>
                                  <div class="col-sm-2 col-md-2 text-left">
                                      <input type="text" id="std_lname" name="std_lname"><br>
                                      <span id="span-lname"class="text-right" style="display:none; color:red">กรุณาระบุนามสกุล</span>
                                  </div>
                                  <div class="col-sm-4 col-md-2 text-left">
                                      <button type="button" class="btn btn-primary"
                                          onclick="showStudent(this.value);" data-toggle="tooltip"
                                          data-placement="right" title="ค้นหานักเรียน">
                                          <i class="fa fa-search" aria-hidden="true"></i>
                                      </button>
                                  </div>
                          </div>
                      </tbody></table>
                      </div>
                      <div id="showStudent" style="display:none">
                      <table id="tableStudent" class="hover" cellspacing="0" width="80%">
                          <thead>
                              <tr>
                                  <th class="col-sm-4 col-md-1 text-center">รหัสนักเรียน</th>
                                  <th class="col-sm-4 col-md-2 text-center">ชื่อ</th>
                                  <th class="col-sm-4 col-md-2 text-center">นามสกุล</th>
                                  <th class="col-sm-4 col-md-1 text-center">ชั้น</th>
                              </tr>
                          </thead>

                          <tbody id="tableStudentBody">

                          </tbody>
                      </table>
                  </div>
              </div>
                  <!--form-->

              </div>
              <!--เลือกคอร์สเรียน-->
              <div class="box-body">
                  <div class="panel panel-default" id="showCourse" style="display:none">
                      <div class="panel-heading">
                          <h3 class="panel-title">เลือกคอร์ส</h3>
                      </div>
                      <!--check error-->
                      <div class="panel-body">

                          {!! csrf_field() !!}
                          @if(count($errors))
                          <div class="alert alert-danger">
                              <strong>Whoops!</strong> There were some problems with your input.
                              <br/>
                              <ul>
                                  @foreach($errors->all() as $error)
                                  <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                          @endif
                          <div class="row">
                              <span class="col-sm-2 col-md-2 text-right">วิชา:</span>
                              <div class="col-sm-4 col-md-4">

                                  <!--<input list="opt_subject" name="subject_list" class="form-control" placeholder="เลือกวิชา">-->
                                  <select id="subject_list" name="subject_list" class="form-control" onchange="selectSubject(this.value)">
                                      <option id="">--เลือกวิชา--</option>
                                      @foreach($all_subject as $subjectlist)
                                      <option id="{{ $subjectlist->subject_id }}" value="{{ $subjectlist->subject_id }}">
                                          {{ $subjectlist->subject_name }}
                                      </option>
                                      @endforeach
                                  </select>
                                  <input type="hidden" id="subject_id" name="subject_id">
                              </div>
                          </div>
                          <div>
                              <table id="tableCourse" class="display" cellspacing="0" width="100%" >
                                  <thead>
                                      <tr>
                                          <th class="col-sm-4 col-md-1 text-center">รหัส</th>
                                          <th class="col-sm-4 col-md-2 text-center">ชื่อคอร์ส</th>
                                          <th class="col-sm-4 col-md-2 text-center">วันเรียน</th>
                                          <th class="col-sm-4 col-md-2 text-center">เวลาเรียน</th>
                                          <th class="col-sm-4 col-md-1 text-center">ห้องเรียน</th>
                                          <th class="col-sm-4 col-md-2 text-center">วันเริ่มเรียน</th>
                                          <th class="col-sm-4 col-md-2 text-center">วันสิ้นสุด</th>
                                          <th class="col-sm-4 col-md-1 text-center">ราคา</th>
                                          <th class="col-sm-4 col-md-1 text-center">ชั่วโมง</th>
                                          <th class="col-sm-4 col-md-1 text-center">สถานะ</th>
                                          <th class="col-sm-4 col-md-1 text-center"></th>

                                      </tr>
                                  </thead>
                                  <tbody id="tableCourseBody">
                                      @foreach($arr_course_schedule as $course_schedule_list)
                                      <tr>
                                          <td class="text-center">{{$course_schedule_list->course_schedule_id}}</td>
                                          <td class="text-center">{{$course_schedule_list->course_name}}</td>
                                          <td class="text-center">{{$course_schedule_list->day}}</td>
                                          <td class="text-center">{{$course_schedule_list->start_time}} - {{$course_schedule_list->end_time}} น.</td>
                                          <td class="text-center">{{$course_schedule_list->room_name}}</td>
                                          <td class="text-center">{{$course_schedule_list->start_date}}</td>
                                          <td class="text-center">{{$course_schedule_list->end_date}}</td>
                                          <td class="text-center">{{$course_schedule_list->price}}</td>
                                          <td class="text-center">{{$course_schedule_list->number_of_time}}</td>
                                          <td class="text-center">{{$course_schedule_list->status}}</td>
                                          <td><button type="button" class="btn btn-success" onclick="enrollCourse({{$course_schedule_list->course_schedule_id}});">ซื้อ</button></td>
                                          <!--<input type="hidden" id="cs_id" value="{{$course_schedule_list->course_schedule_id}}">-->
                                          <!--   <td class="text-center"><input type="radio"></td>-->
                                          <!--<td class="text-center">
                                              <a href="javaScript:;"
                                                  onclick="enrollCourse({{$course_schedule_list->course_schedule_id}});">
                                                  <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                              </a>
                                          </td>-->
                                      </tr>
                                      @endforeach
                                  </tbody>

                              </table>
                          </div>
                      </div>

                  </div>
              </div>

          </div>
          <div role="tabpanel" class="tab-pane" id="courseInfo">
              <!-- Class Schedule table -->
              <table id="tableClassMgt" class="table table-striped table-bordered" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th class="text-left">ชื่อคอร์ส</th>
                          <th class="text-center">วัน</th>
                          <th class="text-center">เวลา</th>
                          <th class="text-left">ห้องเรียน</th>
                          <th class="text-left">วันที่เริ่มเรียน-ถึงวันที่</th>
                          <th class="text-center">จำนวนครั้งที่เรียน</th>
                          <th class="text-left">ราคา</th>
                          <th class="text-left">วันที่สร้างข้อมูล</th>
                          <th class="text-center">ชื่อ</th>
                          <th class="text-center">นามสกุล</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($arr_courseEnroll_list as $ce_list)
                      <tr>
                          <td class="text-center">{{$ce_list->course_name}}</td>
                          <td class="text-center">{{$ce_list->day}}</td>
                          <td class="text-center">{{$ce_list->start_time}} - {{$ce_list->end_time}} น.</td>
                          <td class="text-center">{{$ce_list->room_name}}</td>
                          <td class="text-center">{{$ce_list->start_date}}</td>
                          <td class="text-center">{{$ce_list->end_date}}</td>
                          <td class="text-center">{{$ce_list->number_of_time}}</td>
                          <td class="text-center">{{$ce_list->price}}</td>
                          <td class="text-center">{{$ce_list->firstname}}</td>
                          <td class="text-center">{{$ce_list->lastname}}</td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
        </div>
<!--/.box-body-->
</div>
@include('layouts.partials.script_course_enroll')
@endsection
