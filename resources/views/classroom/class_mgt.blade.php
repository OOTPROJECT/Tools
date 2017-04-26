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
                                    @if(count($all_teacher) > 0)
                                        @foreach($all_teacher as $teacher)
                                            <option value="{{ $teacher->teacher_id }}">
                                                {{ $teacher->firstname }} {{ $teacher->lastname }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="none">ไม่มีข้อมูล</option>
                                    @endif
                                </select>
                            </div>
                        </div></br>
                        <div class="row">
                            <span class="col-sm-2 col-md-2 text-right">วันที่เริ่มเรียน:</span>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                                    <div id="div_stdate" class="datepicker input-group date"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-start-date="+0d">
                                        <input class="form-control" type="text"
                                            id="start_date" name="start_date"
                                            value="" readonly />
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
                                    <div id="div_enddate" class="datepicker1 input-group date"
                                        data-date-format="yyyy-mm-dd"
                                        >
                                        <input class="form-control" type="text"
                                            id="end_date" name="end_date" value="" readonly />
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-calendar"></i>
                                        </span>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                </div>
                            </div>
                        </div></br>
                        <!--<div class="col-sm-6 col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>-->
                        <div class="row">
                            <span class="col-sm-2 col-md-2 text-right">ห้องเรียน:</span>
                            <div class="col-sm-4 col-md-4 text-left">
                                <select class="form-control" id="classroom" name="classroom">
                                    @if(count($all_classroom) > 0)
                                        @foreach($all_classroom as $classroom)
                                            <option id="{{ trim($classroom->room_name) }}">
                                                {{ trim($classroom->room_name) }}
                                            </option>
                                            @endforeach
                                    @else
                                        <option id="none">ไม่มีข้อมูล</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-3 col-md-3 text-left">
                                <button type="button" class="btn btn-primary"
                                    onclick="chkTimeTable();" data-toggle="tooltip"
                                    data-placement="right" title="ค้นหาวัน-เวลาเรียน">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div></br>
                        <div class="col-sm-1 col-md-1"></div>
                        <div id="div_time_table" name="div_time_table"
                            class="panel panel-default col-sm-6 col-md-10"
                            style="display:none">
                            <div class="panel-body">
                                <table id="tb_time_table" class="table">
                                    <thead>
                                        <tr>
                                            <th class="col-sm-4 col-md-4 text-center">
                                                วัน-เวลาเรียน
                                            </th>
                                            <th class="col-sm-3 col-md-3 text-left">
                                                จัดการ
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div></br>
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
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(document).ready(function (){
        var date = new Date();
        date.setDate(date.getDate() + 14);
        var end_date = date.toISOString().slice(0,10).replace(/-/g,"-");

        $("#div_enddate, .datepicker1").datepicker({
            autoclose: true,
            todayHighlight: true,
            startDate: "+14d"
        }).datepicker('update', end_date);

        $("#div_stdate, .datepicker").datepicker({
            autoclose: true,
            todayHighlight: true
        })
        .on('changeDate', function(ev) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 14);

            $("#div_enddate, .datepicker1").datepicker('remove');
            $("#div_enddate, .datepicker1").datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate: newDate
            }).datepicker('update', newDate);
        });
    });

    function chkTimeTable() {
        var start_date = $('input[name=start_date]').val();
        var end_date = $('input[name=end_date]').val();
        var room_name = $('#classroom option:selected').text();
        //var set_room_name = set.replace(/ /g, '%20');
        room_name=room_name.trim().replace(/ /g, '%20');
        console.log(start_date);
        console.log(end_date);
        console.log(room_name);
        $.ajax({
            type: 'GET',
            url: "{{ url('/getTimeTable') }}",
            data: { start_date: start_date, end_date: end_date, room_name: room_name },
            dataType: 'json',
            success: function (data) { //console.log(data);
                $.each(data, function(index, time_table) {
                    var $tr = $('<tr>').append(
                        $('<td class="col-sm-4 col-md-4 text-center">').text(time_table.day + " (" + time_table.start_time
                            + " - " + time_table.end_time + " น.)"),
                        $('<td class="col-sm-3 col-md-3 text-left">').html(
                            '<button type="button" class="btn btn-success"' +
                            ' onclick="createCourseSchedule(' + time_table.time_table_id + ');" tootip="เลือกและบันทึก">' +
                            ' จอง</button>')
                    ).appendTo('#tb_time_table');
                });
            }
        });
        $("#div_time_table").show();
    }

    function createCourseSchedule(time_table_id) {
        var course_id = $('#course option:selected'). val();
        var teacher_id = $('#teacher option:selected').val();
        var start_date = $('input[name=start_date]').val();
        var end_date = $('input[name=end_date]').val();
        console.log(course_id);
        console.log(teacher_id);
        console.log(start_date);
        console.log(end_date);
        console.log(time_table_id);
        /*$.ajax({
            type: 'POST',

        })*/
    }
</script>
@endsection
