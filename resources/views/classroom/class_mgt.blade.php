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
                                    <div id="div_stdate" class="datepicker input-group date"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-start-date="+0d">
                                        <input class="form-control" type="text"
                                            name="start_date"
                                            value="{{ old('start_date') }}" readonly />
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
                                    <div id="div_enddate" class="datepicker input-group date"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-start-date="+14d">
                                        <input class="form-control" type="text"
                                            name="end_date" value="{{ old('end_date') }}" readonly />
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
                            <div class="col-sm-6 col-md-12 text-right">
                                <button type="button" class="btn btn-success"
                                    onclick="chkTimeTable();">
                                    ตรวจสอบเวลาเรียน
                                </button>
                            </div>
                        </div></br>
                        <div id="div_time_table" name="div_time_table"
                            class="panel panel-default col-sm-6 col-md-12"
                            style="display:none">
                            <div class="panel-body">
                                <table id="tb_time_table" class="table">
                                    <thead>
                                        <tr>
                                            <th class="col-sm-3 col-md-3 text-center">
                                                ชื่อห้องเรียน
                                            </th>
                                            <th class="col-sm-3 col-md-3 text-center">
                                                วัน-เวลาเรียน
                                            </th>
                                            <th class="col-sm-3 col-md-3 text-center">
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
    function chkTimeTable() {
        var start_date = $('input[name=start_date]').val();
        var end_date = $('input[name=end_date]').val();
        console.log(start_date);
        console.log(end_date);
        $.ajax({
            type: 'GET',
            url: "{{ url('/getTimeTable') }}",
            data: { start_date: start_date, end_date: end_date },
            dataType: 'json',
            success: function (data) { //console.log(data);
                $.each(data, function(index, time_table) {
                    var $tr = $('<tr>').append(
                        $('<td class="col-sm-3 col-md-3 text-center">').text(time_table.room_name),
                        $('<td class="col-sm-3 col-md-3 text-center">').text(time_table.day + " (" + time_table.start_time
                            + " - " + time_table.end_time + " น.)"),
                        $('<td class="col-sm-3 col-md-3 text-center">').html(
                            '<button type="button" class="btn btn-primary"' +
                            'data-toggle="tooltip" data-placement="right"' +
                            'title="เลือกและบันทึก"' +
                            ' onclick="createCourseSchedule();" tootip="เลือกและบันทึก">' +
                            '<i class="fa fa-floppy-o" aria-hidden="true"></i></button>')
                    ).appendTo('#tb_time_table');
                });
            }
        });
        $("#div_time_table").show();
    }

    function createCourseSchedule() {
        alert("Coming Soon!");
    }
</script>
@endsection
