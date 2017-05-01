@extends('layouts.app')
@extends('layouts.partials.scripts')
@section('htmlheader_title')
รายชื่อนักเรียน
@endsection

@section('contentheader_title')
รายชื่อนักเรียน
@endsection

@section('main-content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div>
    <div class="box-body">


        <table id="example" >
            <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>ชื่อเล่น</th>
                        <th>วันเดือนปีเกิด</th>
                        <th>เพศ</th>
                        <th>ชื่อโรงเรียน</th>
                        <th>ระดับชั้นประถมศึกษา</th>
                        <th>ชื่อผู้ปกครอง</th>
                        <th>นามสกุลผู้ปกครอง</th>
                        <th>ความสัมพันธ์กับนักเรียน</th>
                        <th>อีเมล์</th>
                        <th>เบอร์โทรศัพท์</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($allStudents != null && count($allStudents) > 0 )
                    @foreach($allStudents as $value)
                    <tr>
                        <td>{{$value->firstname}}</td>
                        <td>{{$value->lastname}}</td>
                        <td>{{$value->nickname}}</td>
                        <td>{{$value->std_birthdate}}</td>
                        <td>{{$value->gender}}</td>
                        <td>{{$value->schoolname}}</td>
                        <td>{{$value->school_level}}</td>
                        <td>{{$value->parent_fname}}</td>
                        <td>{{$value->parent_lname}}</td>
                        <td>{{$value->student_relationship}}</td>
                        <td>{{$value->email}}</td>
                        <td>{{$value->mobile}}</td>
                        <td>
                            <a href="{{ url('/EditStudent') }}/{{ $value->student_id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="{{ url('/deleteStudent') }}/{{ $value->student_id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <!--<a href="{{ url('/teacherUpdate') }}/{{ $value->teacher_id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>-->

                        </td>

                    </tr>
                    @endforeach
                    @endif
                </tbody>



            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    </script>
    @endsection
