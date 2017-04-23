@extends('layouts.app')
@extends('layouts.partials.scripts')

@section('htmlheader_title')
    จัดคลาสเรียน
@endsection

@section('contentheader_title')
    จัดคลาสเรียน
@endsection

@section('main-content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        <div class="box-body">
            <form action="{{ url('/createTeacher') }}" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">สร้างคลาสเรียน</h3>
                    </div>
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
                            <span class="col-sm-2 col-md-2 text-right">ชื่อคอร์ส:</span>
                            <div class="col-sm-4 col-md-4 text-left">
                                <select class="form-control" id="course" name="course">
                                    @if(count($all_course) > 0)
                                        @foreach($all_course as $course)
                                            <option value="{{ $course->course_id }}">
                                                {{ $course->course_name }}
                                            </option>
                                        @endforeach
                                    @else
                                    <option value="error">ไม่มี</option>
                                    @endif
                                </select>
                            </div>
                            <span class="col-sm-2 col-md-2 text-right">ครูผู้สอน:</span>
                            <div class="col-sm-4 col-md-4 text-left">
                                <select class="form-control" id="teacher" name="teacher">

                                            <option value="1">
                                                ครูสมชาย
                                            </option>

                                </select>
                            </div>
                        </div></br>
                        <div class="row">
                            <span class="col-sm-2 col-md-2 text-right">วันที่เริ่มเรียน:</span>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                                    <div id="div_stdate" class="datepicker input-group date" data-date-format="yyyy-mm-dd">
                                        <input class="form-control" type="text" name="start_date" value="{{ old('start_date') }}" readonly />
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-calendar"></i>
                                        </span>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                </div>
                            </div>
                            <span class="col-sm-2 col-md-2 text-right">ถึงวันที่:</span>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                                    <div id="div_enddate" class="datepicker input-group date" data-date-format="yyyy-mm-dd">
                                        <input class="form-control" type="text" name="start_date" value="{{ old('end_date') }}" readonly />
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-calendar"></i>
                                        </span>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                </div>
                            </div>
                        </div></br>
                        <div class="row">
                            <span class="col-sm-2 col-md-2 text-right">ห้องเรียน:</span>
                            <div class="col-sm-4 col-md-4 text-left">
                                <select class="form-control" id="room" name="room">

                                    <option value="1">
                                        ห้องเรียน A
                                    </option>
                                </select>
                            </div>
                            <span class="col-sm-2 col-md-2 text-right">วันเวลาเรียน:</span>
                            <div class="col-sm-4 col-md-4 text-left">
                                <select class="form-control" id="time_table" name="time_table">
                                    @if(count($all_time_table) > 0)
                                        @foreach($all_time_table as $time_table)
                                            <option value="{{ $time_table->time_table_id }}">
                                                {{ $time_table->day }}
                                                ( {{ $time_table->start_time }} - {{ $time_table->end_time }} น.)
                                            </option>
                                        @endforeach
                                    @else
                                    <option value="error">ไม่มี</option>
                                    @endif
                                </select>
                            </div>
                        </div></br>
                        <div class="col-sm-6 col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Class Schedule table -->
            <div class="panel panel-default">
  <div class="panel-body">
      <table id="example" >
          <thead>
                 <tr>
                     <th>Name</th>
                     <th>Position</th>
                     <th>Office</th>
                     <th>Age</th>
                     <th>Start date</th>
                     <th>Salary</th>
                 </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>Tiger Nixon</td>
                     <td>System Architect</td>
                     <td>Edinburgh</td>
                     <td>61</td>
                     <td>2011/04/25</td>
                     <td>$320,800</td>
                 </tr>
             </tbody></table>
                                      </div>
                                      <!-- /.box-body -->
                                  </div>
  </div>
</div>

        </div>
        <!-- /.box-body -->
    </div>

@endsection
