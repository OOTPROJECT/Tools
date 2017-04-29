@extends('layouts.app')
@extends('layouts.partials.scripts')

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
        <div class="panel panel-default">
            <div class="panel-body">
                <table id="tablePayroll" >
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
                                        {{ $course_enroll->course_hours }}
                                    </td>
                                    <td class="text-center">
                                        {{ $course_enroll->start_date }} -
                                        {{ $course_enroll->end_date }}
                                    </td>
                                    <td class="text-center">
                                        {{ $hire = $obj->calHire($course_enroll->course_hours, $hiring_rate) }}
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

<script>
    $(document).ready(function () {
        $('#tablePayroll').dataTable( {
            "language": {
                "search": "ค้นหาชื่อครู:"
            },
            "columnDefs": [
                { "searchable": false, "targets": [1, 2, 3, 4, 5, 6] }
            ]
        });
    });

    function createPayroll(cs_id, teacher_id, hire) {
        $.ajax({
            type: 'POST',
            url: "{{ url('/createPayroll') }}",
            data: { course_schedule_id: cs_id, teacher_id: teacher_id, hire: hire,
                     _token: "{{ csrf_token() }}" },
            dataType: 'json',
            success: function(data) {
                //console.log(data);
                if(data.resp == true) {
                    toastr.info(data.text, "ข้อมูลค่าจ้างสอน");

                    // Set delay time 3 sec before reload page.
                    setTimeout(function(){
                        location.reload();
                    },2000);
                }
                else {
                    toastr.error(data.text, "ข้อมูลค่าจ้างสอน");
                }
            }
        });
    }
</script>

@endsection
