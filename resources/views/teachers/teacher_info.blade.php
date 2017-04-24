@extends('layouts.app')
@extends('layouts.partials.scripts')

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
                <th>ชื่อ</th>
                <th>นามสกุล</th>
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
                        <td>{{$value->firstname}}</td>
                        <td>{{$value->lastname}}</td>
                        <td>{{$value->personal_id}}</td>
                        <td>{{$value->gender}}</td>
                        <td>{{$value->mobile}}</td>
                        <td>{{$value->email}}</td>
                        <td>
                            <!--<a href="{{ url('/teacherUpdate') }}/{{ $value->teacher_id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>-->
                            <a href="{{ url('/teacherEdit') }}/{{ $value->teacher_id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="{{ url('/DeleteTeacher') }}"><i class="fa fa-trash" aria-hidden="true"></i></a>

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
