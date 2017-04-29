@extends('layouts.app')
@extends('layouts.partials.scripts')

@section('htmlheader_title')
คำนวณค่าจ้างครู
@endsection

@section('contentheader_title')
คำนวณค่าจ้างครูผู้สอน
@endsection

@section('main-content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div>

    <div class="box-body">
        <!-- Class Schedule table -->
        <div class="panel panel-default">
            <div class="panel-body">
                <table id="example" >
                    <thead>
                        <tr>
                            <th>ชื่อผู้สอน</th>
                            <th>คอร์สเรียน</th>
                            <th>วัน</th>
                            <th>เวลา</th>
                            <th>จำนวนครั้ง</th>
                            <th>วันที่เริ่มเรียน-ถึงวันที่</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($arr_course_enroll) > 0)
                            @foreach($arr_course_enroll as $course_enroll)
                                <tr>
                                    <td>{{ $course_enroll->firstname }}
                                        {{ $course_enroll->lastname }}
                                    </td>
                                    <td>{{ $course_enroll->course_name }}</td>
                                    <td>{{ $course_enroll->day }}</td>
                                    <td>{{ $course_enroll->start_time }} -
                                        {{ $course_enroll->end_time }} น.
                                    </td>
                                    <td>{{ $course_enroll->course_hours }}</td>
                                    <td>{{ $course_enroll->start_date }} -
                                        {{ $course_enroll->end_date }}
                                    </td>
                                    <td><button type="button" class="btn btn-success">จ่ายเงิน</button></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">ไม่มีข้อมูล</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <!-- /.box-body -->
</div>

@endsection
