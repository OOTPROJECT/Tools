@extends('layouts.app')
@extends('layouts.partials.scripts')

@section('htmlheader_title')
การซื้อคอร์ส
@endsection

@section('contentheader_title')
การซื้อคอร์ส
@endsection

@section('main-content')

<script type="text/javascript">
/* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function(slects,data, dataIndex ) {
        var std_id = parseInt( $('#std_id').val(), 10 );
        var std_id = parseInt( $('#std_id').val(), 10 );
        var id = parseFloat( data[0] )|| 0; // use data for the age column

        if (std_id == id)
        {
            return true;
        }
        return false;
    }
);
/*Create table*/
$(document).ready(function() {
    $('table.hover').DataTable({
        "paging":   false,
        "info":     false,
        //"filter": false,
        //"dom": '<"toolbar">frtip'
    });
    $('#std_id').keyup( function() {
        table.hover.draw();
    } );
    //$("div.toolbar").html('<b>ใส่รหัสนักเรียน</b>');
    $('table.display').DataTable({
        "info":     false,
        "paging":   false,
        "filter": false,
    });

} );

function selectSubject() {
    var subject_id = $('#subject_list option:selected').val();
    console.log(subject_id);
    //clear table
    $('#tableCourse').empty();

    // Replace space with %20
    //room_name=room_name.trim().replace(/ /g, '%20');

    $.ajax({
        type: 'GET',
        url: "{{ url('/getCourseBySubject') }}",
        data: { subject_id: subject_id},
        dataType: 'json',
        success: function (data) { console.log(data.length);
            if(data.length > 0) {
                $.each(data, function(index, course_schedule) {
                    var $tr = $('<tr>').append(
                        $('<td class="col-sm-4 col-md-4 text-center">').text(course_schedule.course_schedule_id),
                        $('<td class="col-sm-4 col-md-4 text-center">').text(course_schedule.course_name),
                        $('<td class="col-sm-4 col-md-4 text-center">').text(course_schedule.day),
                        $('<td class="col-sm-4 col-md-4 text-center">').text(course_schedule.start_time),
                        $('<td class="col-sm-4 col-md-4 text-center">').text(course_schedule.end_time),
                        $('<td class="col-sm-4 col-md-4 text-center">').text(course_schedule.room_name),
                        $('<td class="col-sm-4 col-md-4 text-center">').text(course_schedule.start_date),
                        $('<td class="col-sm-4 col-md-4 text-center">').text(course_schedule.end_date),
                        $('<td class="col-sm-4 col-md-4 text-center">').text(course_schedule.hours),
                        $('<td class="col-sm-4 col-md-4 text-center">').text(course_schedule.status)
                    ).appendTo('#tableCourse');
                });
            }
            else {
                var $tr = $('<tr>').append(
                    $('<td colspan="2" class="col-sm-4 col-md-4 text-center">').text("ไม่มีช่วงเวลาเรียนว่าง")
                ).appendTo('#tableCourse');
            }
        }
    });
}

</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div>
    <!---ข้อมูลนักเรียน-->
    <div class="box-body">
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
                <table border="0" cellspacing="5" cellpadding="5">
                    <tbody><tr>
                        <td>ค้นหารหัสนักเรียน :</td>
                        <td><input type="text" id="std_id" name="std_id"></td>
                    </tr>
                </tbody></table>
                <table id="" class="hover" cellspacing="0" width="80%" >
                    <thead>
                        <tr>
                            <th>รหัสนักเรียน</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>ชั้น</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($all_student as $studentlist)
                        <tr>
                            <td>{{ $studentlist->student_id }}</td>
                            <td>{{ $studentlist->firstname }}</td>
                            <td>{{ $studentlist->lastname }}</td>
                            <td>{{ $studentlist->school_level }}</td>

                        </tr>
                        @endforeach
                        <tr>
                            <td>1234</td>
                            <td>ด.ญ.ดีใจ</td>
                            <td>ใจดี</td>
                            <td>G.2</td>
                        </tr>
                        <tr>
                            <td>1235</td>
                            <td>ด.ญ. ใจเย็น</td>
                            <td>เย็นใจ</td>
                            <td>G.3</td>
                        </tr>


                    </tbody>
                </table>

            </div>
            <!--form-->

        </div>
        <!--เลือกคอร์สเรียน-->
        <div class="box-body">
            <div class="panel panel-default">
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
                                    <th>วิชา</th>
                                    <th >ชื่อคอร์ส</th>
                                    <th>จำนวนชั่วโมง</th>
                                    <th>ราคา</th>

                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>คณิตศาสตร์</td>
                                    <td>คณิตป.3</td>
                                    <td>20</td>
                                    <td>3,500</td>
                                </tr>
                                <tr>
                                    <td>คณิตศาสตร์</td>
                                    <td>คณิตป.4</td>
                                    <td>20</td>
                                    <td>3,600</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
<!--/.box-body-->
</div>
@endsection
