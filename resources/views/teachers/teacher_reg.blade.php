@extends('layouts.app')

@section('htmlheader_title')
การสมัครสอนพิเศษ
@endsection

@section('contentheader_title')
การสมัครสอนพิเศษ
@endsection

@section('main-content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div>
    <div class="box-body">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">ข้อมูลผู้สมัครสอนพิเศษ</h3>
            </div>
            <div class="panel-body">
                <form action="{{ url('/teacher') }}" method="post">
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
                        <div class="col-sm-2 col-md-2 text-right">ชื่อ:</div>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('teacher_fname') ? 'has-error' : '' }}">
                                <input type="text" name="teacher_fname" class="form-control"
                                placeholder="">
                                <span class="text-danger">{{ $errors->first('std_fname') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2 text-right">นามสกุล:</div>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('teacher_lname') ? 'has-error' : '' }}">
                                <input type="text" name="teacher_lname" class="form-control"
                                placeholder="" value="{{ old('std_lname') }}">
                                <span class="text-danger">{{ $errors->first('std_lname') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-md-2 text-right">วันเกิด:</div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group {{ $errors->has('reg_date') ? 'has-error' : '' }}">
                                <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input class="form-control" type="text" name="reg_date" readonly />
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                </div>
                                <span class="text-danger">{{ $errors->first('reg_date') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2 text-right">รหัสประจำตัวประชาชน:</div>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('teacher_lname') ? 'has-error' : '' }}">
                                <input type="text" name="teacher_lname" class="form-control"
                                placeholder="" value="{{ old('std_lname') }}">
                                <span class="text-danger">{{ $errors->first('std_lname') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-md-2 text-right">เพศ:</div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group {{ $errors->has('reg_date') ? 'has-error' : '' }}">
                                <label class="radio-inline">
                                    <input type="radio" name="optradio">&nbsp;&nbsp;ชาย &nbsp;&nbsp;&nbsp;
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="optradio">หญิง&nbsp;&nbsp;&nbsp;
                                </label>
                                <span class="text-danger">{{ $errors->first('reg_date') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2 text-right">อีเมล์:</div>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('teacher_lname') ? 'has-error' : '' }}">
                                <input type="text" name="teacher_lname" class="form-control"
                                placeholder="" value="{{ old('std_lname') }}">
                                <span class="text-danger">{{ $errors->first('std_lname') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-md-2 text-right">เบอร์โทรศัพท์:</div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group {{ $errors->has('teacher_lname') ? 'has-error' : '' }}">
                                <input type="text" name="teacher_lname" class="form-control"
                                placeholder="" value="{{ old('std_lname') }}">
                                <span class="text-danger">{{ $errors->first('std_lname') }}</span>
                            </div>
                            <span class="text-danger">{{ $errors->first('reg_date') }}</span>
                        </div>
                        <div class="col-sm-2 col-md-2 text-right">เบอร์บ้าน:</div>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('teacher_lname') ? 'has-error' : '' }}">
                                <input type="text" name="teacher_lname" class="form-control"
                                placeholder="" value="{{ old('std_lname') }}">
                                <span class="text-danger">{{ $errors->first('std_lname') }}</span>
                            </div>
                        </div>
                    </div>
                </br>

                <h3 style="border-bottom:1px;">&nbsp;ที่อยู่</h3>
                <div class="row">
                    <div class="col-sm-2 col-md-2 text-right">บ้านเลขที่:</div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group {{ $errors->has('teacher_lname') ? 'has-error' : '' }}">
                            <input type="text" name="teacher_lname" class="form-control"
                            placeholder="" value="{{ old('std_lname') }}">
                            <span class="text-danger">{{ $errors->first('std_lname') }}</span>
                        </div>
                        <span class="text-danger">{{ $errors->first('reg_date') }}</span>
                    </div>
                    <div class="col-sm-2 col-md-2 text-right">ถนน:</div>
                    <div class="col-sm-4 col-md-4 text-left">
                        <div class="form-group {{ $errors->has('teacher_lname') ? 'has-error' : '' }}">
                            <input type="text" name="teacher_lname" class="form-control"
                            placeholder="" value="{{ old('std_lname') }}">
                            <span class="text-danger">{{ $errors->first('std_lname') }}</span>
                        </div>
                        <span class="text-danger">{{ $errors->first('reg_date') }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 col-md-2 text-right">จังหวัด:</div>
                    <div class="col-sm-4 col-md-4">
                        <select class="form-control">
                        </select>
                    </div>
                    <div class="col-sm-2 col-md-2 text-right">เขต/อำเภอ:</div>
                    <div class="col-sm-4 col-md-4 text-left">
                        <select class="form-control">
                        </select>
                    </div>
                </div></br>
                <div class="row">
                    <div class="col-sm-2 col-md-2 text-right">แขวง/ตำบล:</div>
                    <div class="col-sm-4 col-md-4 text-left">
                        <select class="form-control">
                        </select>
                    </div>
                    <div class="col-sm-2 col-md-2 text-right">รหัสไปรษณีย์:</div>
                    <div class="col-sm-4 col-md-4 text-left">
                        <div class="form-group {{ $errors->has('teacher_lname') ? 'has-error' : '' }}">
                            <input type="text" name="teacher_lname" class="form-control"
                            placeholder="" value="{{ old('std_lname') }}">
                            <span class="text-danger">{{ $errors->first('std_lname') }}</span>
                        </div>
                        <span class="text-danger">{{ $errors->first('reg_date') }}</span>
                    </div>
                </div></br>
                <h3 style="border-bottom:1px;">&nbsp;ระดับการศึกษา</h3>
                <div class="row">
                    <div class="col-sm-2 col-md-2 text-right">ระดับ:</div>
                    <div class="col-sm-4 col-md-4 text-left">
                        <select class="form-control">
                        </select>
                    </div>
                    <div class="col-sm-2 col-md-2 text-right">สาขา:</div>
                    <div class="col-sm-4 col-md-4 text-left">
                        <div class="form-group {{ $errors->has('teacher_lname') ? 'has-error' : '' }}">
                            <input type="text" name="teacher_lname" class="form-control"
                            placeholder="" value="{{ old('std_lname') }}">
                            <span class="text-danger">{{ $errors->first('std_lname') }}</span>
                        </div>
                        <span class="text-danger">{{ $errors->first('reg_date') }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 col-md-2 text-right">มหาวิทยาลัย:</div>
                    <div class="col-sm-4 col-md-4 text-left">
                        <div class="form-group {{ $errors->has('teacher_lname') ? 'has-error' : '' }}">
                            <input type="text" name="teacher_lname" class="form-control"
                            placeholder="" value="{{ old('std_lname') }}">
                            <span class="text-danger">{{ $errors->first('std_lname') }}</span>
                        </div>
                        <span class="text-danger">{{ $errors->first('reg_date') }}</span>
                    </div>
                </div>

            </form>
        </div>

    </div>


</div>
<!-- /.box-body -->
</div>
<script type="text/javascript">
$('.datepicker').datepicker(
	format: 'dd/MM/yyyy'
);</script>
@endsection
