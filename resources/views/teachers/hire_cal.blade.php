@extends('layouts.app')
@section('htmlheader_title')
ข้อมูลค่าจ้างสอน
@endsection

@section('contentheader_title')
ข้อมูลค่าจ้างสอน
@endsection

@section('main-content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div>

    <div class="box-body">
        <!-- Class Schedule table -->
                <table id="tablePayroll" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-left">ชื่อผู้สอน</th>
                            <th class="text-left">คอร์สเรียน</th>
                            <th class="text-center">วัน</th>
                            <th class="text-center">เวลา</th>
                            <th class="text-center">จำนวนครั้ง</th>
                            <th class="text-center">วันที่เริ่ม - ถึงวันที่</th>
                            <th class="text-center">ค่าสอน (บาท)</th>
                            <th class="text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($arr_course_enroll) > 0)
                            @foreach($arr_course_enroll as $course_enroll)
                                <tr>
                                    <td class="text-left">
                                        {{ $course_enroll->firstname }}
                                        {{ $course_enroll->lastname }}
                                    </td>
                                    <td class="text-left">
                                        {{ $course_enroll->course_name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $course_enroll->day }}
                                    </td>
                                    <td class="text-center">
                                        {{ $course_enroll->start_time }} -
                                        {{ $course_enroll->end_time }} น.
                                    </td>
                                    <td class="text-center">
                                        {{ $course_enroll->number_of_time }}
                                    </td>
                                    <td class="text-center">
                                        {{ $course_enroll->start_date }} -
                                        {{ $course_enroll->end_date }}
                                    </td>
                                    <td class="text-center">
                                        {{ $hire = $obj->calHire($course_enroll->number_of_time, $hiring_rate) }}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success"
                                            onclick="createPayroll({{ $course_enroll->course_schedule_id }},
                                            {{ $course_enroll->teacher_id }}, {{ $hire }});">
                                            จ่ายเงิน
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="8">ไม่มีข้อมูล</td>
                                @for($i=0; $i<7; $i++)
                                    <td style="display: none;"></td>
                                @endfor
                            </tr>
                        @endif
                    </tbody>
                </table>
    </div>
    <!-- /.box-body -->
</div>

@include('layouts.partials.scripts_hire_cal')
@endsection
