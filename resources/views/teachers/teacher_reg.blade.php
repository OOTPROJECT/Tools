@extends('layouts.app')
@extends('layouts.partials.scripts')

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
        <form action="{{ url('/createTeacher') }}" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ข้อมูลผู้สมัคร</h3>
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
                        <span class="col-sm-2 col-md-2 text-right">ชื่อ:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
                                <input type="text" name="firstname" class="form-control"
                                placeholder="" value="{{ old('firstname') }}">
                                <span class="text-danger">{{ $errors->first('firstname') }}</span>
                            </div>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">นามสกุล:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
                                <input type="text" name="lastname" class="form-control"
                                placeholder="" value="{{ old('lastname') }}">
                                <span class="text-danger">{{ $errors->first('lastname') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">วันเกิด:</span>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group {{ $errors->has('birthdate') ? 'has-error' : '' }}">
                                <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input class="form-control" type="text" name="birthdate" value="{{ old('personal_id') }}" readonly />
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                </div>
                                <span class="text-danger">{{ $errors->first('birthdate') }}</span>
                            </div>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">รหัสประจำตัวประชาชน:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('personal_id') ? 'has-error' : '' }}">
                                <input type="text" name="personal_id" class="form-control"
                                placeholder="" value="{{ old('personal_id') }}">
                                <span class="text-danger">{{ $errors->first('personal_id') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">เพศ:</span>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="M">&nbsp;&nbsp;ชาย &nbsp;&nbsp;&nbsp;
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="F">หญิง&nbsp;&nbsp;&nbsp;
                                </label>
                                <span class="text-danger">{{ $errors->first('gender') }}</span>
                            </div>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">อีเมล์:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input type="text" name="email" class="form-control"
                                placeholder="" value="{{ old('email') }}">
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">เบอร์โทรศัพท์:</span>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
                                <input type="text" name="mobile" class="form-control"
                                placeholder="" value="{{ old('mobile') }}">
                                <span class="text-danger">{{ $errors->first('mobile') }}</span>
                            </div>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">เบอร์บ้าน:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('tel') ? 'has-error' : '' }}">
                                <input type="text" name="tel" class="form-control"
                                placeholder="" value="{{ old('tel') }}">
                                <span class="text-danger">{{ $errors->first('tel') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-heading">
                    <h3 class="panel-title">ข้อมูลที่อยู่อาศัย</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">บ้านเลขที่:</span>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group {{ $errors->has('home_no') ? 'has-error' : '' }}">
                                <input type="text" name="home_no" class="form-control"
                                placeholder="" value="{{ old('home_no') }}">
                                <span class="text-danger">{{ $errors->first('home_no') }}</span>
                            </div>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">ถนน:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('road_name') ? 'has-error' : '' }}">
                                <input type="text" name="road_name" class="form-control"
                                placeholder="" value="{{ old('road_name') }}">
                                <span class="text-danger">{{ $errors->first('road_name') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">จังหวัด:</span>
                        <div class="col-sm-4 col-md-4">
                            <select class="form-control" id="province_id" name="province_id">
                                @foreach($prov as $prov_list)
                                    <option value="{{ $prov_list->province_id }}">
                                        {{ $prov_list->province_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">เขต/อำเภอ:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <select class="form-control" id="district_id" name="district_id">
                            </select>
                        </div>
                    </div></br>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">แขวง/ตำบล:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <select class="form-control" id="sub_district_id" name="sub_district_id">
                            </select>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">รหัสไปรษณีย์:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('postcode') ? 'has-error' : '' }}">
                                <input type="text" name="postcode" class="form-control"
                                placeholder="" value="{{ old('postcode') }}">
                                <span class="text-danger">{{ $errors->first('postcode') }}</span>
                            </div>
                        </div>
                    </div></br>
                </div>
                <div class="panel-heading">
                    <h3 class="panel-title">ข้อมูลระดับการศึกษา</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">ระดับ:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <select class="form-control" id="degree" name="degree">
                                @foreach($degree_list as $degree_key => $degree_val)
                                <option value="{{ $degree_val }}">
                                    {{ $degree_val }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">สาขา:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('major') ? 'has-error' : '' }}">
                                <input type="text" name="major" class="form-control"
                                placeholder="" value="{{ old('major') }}">
                                <span class="text-danger">{{ $errors->first('major') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">มหาวิทยาลัย:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('university_name') ? 'has-error' : '' }}">
                                <input type="text" name="university_name" class="form-control"
                                placeholder="" value="{{ old('university_name') }}">
                                <span class="text-danger">{{ $errors->first('university_name') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">บันทึก</button>
                <a href="" class="btn btn-default">ยกเลิก</a>
            </div>
        </form>
    </div>
<!-- /.box-body -->
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $("#province_id").change(function (){
            var prov_dd = $(this).val();
            $.ajax({
                type: 'GET',
                url: "{{ url('/districts') }}",
                data: { prov_id: prov_dd },
                dataType: 'json',
                success: function (data) {
                    var select = $("#district_id");
                    select.empty();
                    select.append($('<option/>', {
                        value: 0,
                        text: "กรุณาเลือกเขต/อำเภอ"
                    }));
                    $.each(data, function (index, dist_data) {
                        select.append($('<option/>', {
                            value: dist_data.district_id,
                            text: dist_data.district_name
                        }));
                    });
                    //console.log(data);
                }
            });
        });

        $("#district_id").change(function (){
            var prov_id = $("#province_id").val();
            var dist_dd = $(this).val();
            $.ajax({
                type: 'GET',
                url: "{{ url('/sub_districts') }}",
                data: { prov_id: prov_id, dist_id: dist_dd },
                dataType: 'json',
                success: function (data) {
                    var select = $("#sub_district_id");
                    select.empty();
                    select.append($('<option/>', {
                        value: 0,
                        text: "กรุณาเลือกแขวง/ตำบล"
                    }));
                    $.each(data, function (index, sub_dist_data) {
                        select.append($('<option/>', {
                            value: sub_dist_data.sub_district_id,
                            text: sub_dist_data.sub_district_name
                        }));
                    });
                    //console.log(data);
                }
            });
        });
    });


    //$('.datepicker').datepicker( format: 'dd/MM/yyyy');
</script>
@endsection
