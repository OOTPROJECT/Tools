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
                                placeholder="กรุณาระบุ ชื่อ" value="{{ old('firstname') }}">
                                <span class="text-danger">{{ $errors->first('firstname') }}</span>
                            </div>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">นามสกุล:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
                                <input type="text" name="lastname" class="form-control"
                                placeholder="กรุณาระบุ นามสกุล" value="{{ old('lastname') }}">
                                <span class="text-danger">{{ $errors->first('lastname') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">วันเกิด:</span>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group {{ $errors->has('birthdate') ? 'has-error' : '' }}">
                                <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input class="form-control" type="text" name="birthdate" value="{{ old('birthdate') }}"
                                    placeholder="กรุณาระบุ วันเกิด" readonly />
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
                                placeholder="กรุณาระบุ รหัสประจำตัวประชาชน" value="{{ old('personal_id') }}" maxlength="13">
                                <span class="text-danger">{{ $errors->first('personal_id') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">เพศ:</span>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="M">
                                    &nbsp;&nbsp;ชาย &nbsp;&nbsp;&nbsp;
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="F">
                                    หญิง&nbsp;&nbsp;&nbsp;
                                </label>
                                <span class="text-danger">{{ $errors->first('gender') }}</span>
                            </div>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">อีเมล์:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input type="text" name="email" class="form-control"
                                placeholder="กรุณาระบุ อีเมล์" value="{{ old('email') }}">
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">เบอร์โทรศัพท์:</span>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}" id="mobile">
                                <input type="text" name="mobile" class="form-control" placeholder="กรุณาระบุ เบอร์โทรศัพท์"
                                value="{{ old('mobile') }}" maxlength="10" onKeyUp="inputDigitsMobile(this);">
                                <span class="text-danger">{{ $errors->first('mobile') }}</span>
                            </div>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">เบอร์บ้าน:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('tel') ? 'has-error' : '' }}" id="tel">
                                <input type="text" name="tel" class="form-control"
                                placeholder="กรุณาระบุ เบอร์บ้าน" value="{{ old('tel') }}" maxlength="10" onKeyUp="inputDigitsTel(this);">
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
                                placeholder="กรุณาระบุ บ้านเลขที่" value="{{ old('home_no') }}">
                                <span class="text-danger">{{ $errors->first('home_no') }}</span>
                            </div>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">ถนน:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('road_name') ? 'has-error' : '' }}">
                                <input type="text" name="road_name" class="form-control"
                                placeholder="กรุณาระบุ ถนน" value="{{ old('road_name') }}">
                                <span class="text-danger">{{ $errors->first('road_name') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">จังหวัด:</span>
                        <div class="col-sm-4 col-md-4">
                            <input list="opts_province" name="province_list"
                                class="form-control"
                                placeholder="กรุณาระบุ จังหวัด">
                            <datalist id="opts_province">
                                @foreach($prov as $prov_list)
                                    <option id="{{ $prov_list->province_id }}"
                                        value="{{ $prov_list->province_name }}">
                                    </option>
                                @endforeach
                            </datalist>
                            <input type="hidden" id="province_id" name="province_id">
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">เขต/อำเภอ:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <input list="opts_district" name="district_list"
                                class="form-control"
                                placeholder="กรุณาระบุ เขต/อำเภอ"
                                onclick="chkProvinceInput();">
                            <datalist id="opts_district">
                            </datalist>
                            <input type="hidden" id="district_id" name="district_id">
                        </div>
                    </div></br>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">แขวง/ตำบล:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <input list="opts_sub_district" name="sub_district_list"
                                class="form-control"
                                placeholder="กรุณาระบุ แขวง/ตำบล"
                                onclick="chkDistrictInput();">
                            <datalist id="opts_sub_district">
                            </datalist>
                            <input type="hidden" id="sub_district_id" name="sub_district_id">
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">รหัสไปรษณีย์:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('postcode') ? 'has-error' : '' }}" id="postcode" >
                                <input type="text" name="postcode" class="form-control"
                                    placeholder="กรุณาระบุ รหัสไปรษณีย์" value="{{ old('postcode') }}"
                                    onclick="chkSubDistrictInput();" onKeyUp="inputDigits(this);">
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
                                <option value="">กรุณาเลือกระดับ</option>
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
                                placeholder="กรุณาระบุ สาขา" value="{{ old('major') }}">
                                <span class="text-danger">{{ $errors->first('major') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">มหาวิทยาลัย:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('university_name') ? 'has-error' : '' }}">
                                <input type="text" name="university_name" class="form-control"
                                placeholder="กรุณาระบุ มหาวิทยาลัย" value="{{ old('university_name') }}">
                                <span class="text-danger">{{ $errors->first('university_name') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-12 text-center">
                <button type="submit" class="btn btn-success">บันทึก</button>
                <a href="" class="btn btn-default">ยกเลิก</a>
            </div>
        </form>
    </div>
<!-- /.box-body -->
</div>

<script type="text/javascript">

    $(document).ready(function(){
        var prov_list_id;
        var prov_list_value;
        var dist_list_id;
        var dist_list_value;
        var sub_dist_list_id;
        var sub_dist_list_value;
        $('input[name=province_list]').on('input',function() {
            var selectedOption = $('option[value="'+$(this).val()+'"]');
            if(selectedOption.length) {
                prov_list_id = selectedOption.attr('id');
                prov_list_value = selectedOption.attr('value');
                $('input[name=province_list]').val(prov_list_value);
                $('input[name=province_id]').val(prov_list_id);

                getDistrict(prov_list_id);

            }
        });

        $('input[name=district_list]').on('input',function() {
            var selectedOption = $('option[value="'+$(this).val()+'"]');
            if(selectedOption.length) {
                dist_list_id = selectedOption.attr('id');
                dist_list_value = selectedOption.attr('value');
                $('input[name=district_list]').val(dist_list_value);
                $('input[name=district_id]').val(dist_list_id);

                getSubDistrict(prov_list_id, dist_list_id);

            }
        });

        $('input[name=sub_district_list]').on('input',function() {
            var selectedOption = $('option[value="'+$(this).val()+'"]');
            if(selectedOption.length) {
                sub_dist_list_id = selectedOption.attr('id');
                sub_dist_list_value = selectedOption.attr('value');
                $('input[name=sub_district_list]').val(sub_dist_list_value);
                $('input[name=sub_district_id]').val(sub_dist_list_id);
            }
        });

        $('input[name=district_list]').on( 'keyup', function( e ) {
            if( e.which == 9 ) {
                //console.log( e.target.href );
                chkProvinceInput();
            }
        } );

        $('input[name=sub_district_list]').on( 'keyup', function( e ) {
            if( e.which == 9 ) {
                //console.log( e.target.href );
                chkDistrictInput();
            }
        } );

        $('input[name=postcode]').on( 'keyup', function( e ) {
            if( e.which == 9 ) {
                //console.log( e.target.href );
                chkSubDistrictInput();
            }
        } );
    });

    function chkProvinceInput() {
        var prov_id
        prov_id = $('input[name=province_id]').val();

        if(prov_id.length == 0) {
            $('input[name=province_list]').val("");
        }
    }

    function chkDistrictInput() {
        var dist_id
        dist_id = $('input[name=district_id]').val();

        if(dist_id.length == 0) {
            $('input[name=district_list]').val("");
        }
    }

    function chkSubDistrictInput() {
        var sub_dist_id
        sub_dist_id = $('input[name=sub_district_id]').val();
        if(sub_dist_id.length == 0) {
            $('input[name=sub_district_list]').val("");
        }
    }

    function getDistrict(prov_id) {
        $.ajax({
            type: 'GET',
            url: "{{ url('/districts') }}",
            data: { prov_id: prov_id },
            dataType: 'json',
            success: function (data) {
                var select = $("#opts_district");
                select.empty();
                $.each(data, function (index, dist_data) {
                    select.append($('<option/>', {
                        id: dist_data.district_id,
                        value: dist_data.district_name
                    }));
                });
            }
        });
    }

    function getSubDistrict(prov_id, dist_id) {
        $.ajax({
            type: 'GET',
            url: "{{ url('/sub_districts') }}",
            data: { prov_id: prov_id, dist_id: dist_id },
            dataType: 'json',
            success: function (data) {
                var select = $("#opts_sub_district");
                select.empty();
                $.each(data, function (index, sub_dist_data) {
                    select.append($('<option/>', {
                        id: sub_dist_data.sub_district_id,
                        value: sub_dist_data.sub_district_name
                    }));
                });
            }
        });
    }

    function inputDigitsMobile(sensor){
        var regExp = /[0-9]$/;
        if(!regExp.test(sensor.value)){
            $( "#mobile span.text-danger" ).text("กรุณาระบุเฉพาะตัวเลข");
            $('#mobile span').css('display', 'block');
            sensor.value = sensor.value.substring(0, sensor.value.length -1);
        }
        else {
            $('#mobile span').css('display', 'none');
        }

    }

    function inputDigitsTel(sensor){
        var regExp = /[0-9]$/;
        if(!regExp.test(sensor.value)){
            $( "#tel span.text-danger" ).text("กรุณาระบุเฉพาะตัวเลข");
            $('#tel span').css('display', 'block');
            sensor.value = sensor.value.substring(0, sensor.value.length -1);
        }
        else {
            $( "#tel span" ).css('display', 'none');
        }
    }

    function inputDigits(sensor){
        var regExp = /[0-9]$/;
        if(!regExp.test(sensor.value)){
            $( "#postcode span.text-danger" ).text("กรุณาระบุเฉพาะตัวเลข");
            $('#postcode span').css('display', 'block');
            sensor.value = sensor.value.substring(0, sensor.value.length -1);
        }
        else {
            $( "#postcode span" ).css('display', 'none');
        }
    }

</script>
@endsection
