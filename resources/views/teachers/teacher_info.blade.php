@extends('layouts.app')

@section('htmlheader_title')
รายชื่อครู
@endsection

@section('contentheader_title')
รายชื่อครู
@endsection

@section('main-content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div>
    <div class="box-body">
        <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ชื่อ - นามสกุล</th>
                <!-- <th>นามสกุล</th> -->
                <th>รหัสประจำตัวประชาชน</th>
                <th>เพศ</th>
                <th>เบอร์โทรศัพท์</th>
                <th>อีเมล์</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @if ($allTeacher != null && count($allTeacher) > 0 )
                @foreach($allTeacher as $value)
                    <tr>
                        <td class="column">{{$value->firstname}}  {{$value->lastname}}</td>
                        <td>{{$value->personal_id}}</td>
                        <td>{{$value->getGender($value->gender)}}</td>
                        <td>{{$value->mobile}}</td>
                        <td>{{$value->email}}</td>
                        <td>
                            <a href="{{ url('/teacherEdit') }}/{{ $value->teacher_id }}" data-toggle="tooltip"
                            data-placement="top" title="แก้ไข"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="{{ url('/deleteTeacher') }}/{{ $value->teacher_id }}" data-toggle="tooltip"
                            data-placement="top" title="ลบ"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    </div>
    <!-- /.box-body -->
</div>



@endsection
