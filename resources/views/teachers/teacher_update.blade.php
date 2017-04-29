@extends('layouts.app')
@extends('layouts.partials.scripts')

@section('htmlheader_title')
แก้ไขข้อมูลครู
@endsection

@section('contentheader_title')
แก้ไขข้อมูลครู
@endsection

@section('main-content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div>
    <div class="box-body">
        <form action="{{ url('/updateTeacher')}}/{{ $teacher_id }}" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ข้อมูลผู้สมัคร {{ $teacher->firstname ." "}}  {{ $teacher->lastname }}</h3>
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
                                placeholder="" value="{{ $teacher->firstname}}">
                                <span class="text-danger">{{ $errors->first('firstname') }}</span>
                            </div>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">นามสกุล:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
                                <input type="text" name="lastname" class="form-control"
                                placeholder="" value="{{ $teacher->lastname}}">
                                <span class="text-danger">{{ $errors->first('lastname') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">วันเกิด:</span>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group {{ $errors->has('birthdate') ? 'has-error' : '' }}">
                                <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input class="form-control" type="text" name="birthdate"
                                    value="{{ $teacher->birthdate}}" readonly />
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
                                <input type="text" name="personal_id" class="form-control" placeholder=""
                                value="{{ $teacher->personal_id}}" maxlength="10">
                                <span class="text-danger">{{ $errors->first('personal_id') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">เพศ:</span>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="M" >&nbsp;&nbsp;ชาย &nbsp;&nbsp;&nbsp;
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
                                placeholder="" value="{{ $teacher->email }}">
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">เบอร์โทรศัพท์:</span>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}" id="mobile">
                                <input type="text" name="mobile" class="form-control" placeholder=""
                                value="{{ $teacher->mobile }}" onKeyUp="inputDigitsMobile(this);" maxlength="10">
                                <span class="text-danger">{{ $errors->first('mobile') }}</span>
                            </div>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">เบอร์บ้าน:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('tel') ? 'has-error' : '' }}" id="tel">
                                <input type="text" name="tel" class="form-control" placeholder=""
                                value="{{ $teacher->tel }}" onKeyUp="inputDigitsTel(this);" maxlength="10">
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
                                placeholder="" value=" @if(array_key_exists("0", $address) &&$address[0] != null){{ $address[0] }}@endif">
                                <span class="text-danger">{{ $errors->first('home_no') }}</span>
                            </div>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">ถนน:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('road_name') ? 'has-error' : '' }}">
                                <input type="text" name="road_name" class="form-control"
                                placeholder="" value="@if(array_key_exists("1", $address) && $address[1] != null){{ $address[1] }}@endif">
                                <span class="text-danger">{{ $errors->first('road_name') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">จังหวัด:</span>
                        <div class="col-sm-4 col-md-4">
                            <select class="form-control" id="province_id" name="province_id">
                                @foreach($prov as $prov_list)
                                    @if($teacher->province_id == $prov_list->province_id)
                                        <option value="{{ $prov_list->province_id }}" selected="true">
                                            {{ $prov_list->province_name }}
                                        </option>
                                    @else
                                        <option value="{{ $prov_list->province_id }}">
                                            {{ $prov_list->province_name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <input type="hidden" id="provid" name="provid" value="{{ $teacher->province_id }}">
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">เขต/อำเภอ:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <select class="form-control" id="district_id" name="district_id">
                            </select>
                            <input type="hidden" id="distid" name="distid" value="{{ $teacher->district_id }}">
                        </div>
                    </div></br>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">แขวง/ตำบล:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <select class="form-control" id="sub_district_id" name="sub_district_id">
                            </select>
                            <input type="hidden" id="subdistid" name="subdistid" value="{{ $teacher->sub_district_id }}">
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">รหัสไปรษณีย์:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('postcode') ? 'has-error' : '' }}" id="postcode" >
                                <input type="text" name="postcode" class="form-control"
                                    placeholder="" value="{{ $teacher->postcode }}"
                                    onclick="chkSubDistrictInput();" id="mytextbox" onKeyUp="inputDigits(this);">
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
                                    <option value="{{ $degree_val }}" <?php if($teacher->degree == $degree_val){echo("selected");}?> >
                                        {{ $degree_val }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">สาขา:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('major') ? 'has-error' : '' }}">
                                <input type="text" name="major" class="form-control"
                                placeholder="" value="{{ $teacher->major }}">
                                <span class="text-danger">{{ $errors->first('major') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-sm-2 col-md-2 text-right">มหาวิทยาลัย:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('university_name') ? 'has-error' : '' }}">
                                <input type="text" name="university_name" class="form-control"
                                placeholder="" value="{{ $teacher->university_name }}">
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

        var provid = $('#provid').val();
        var distid = $('#distid').val();
        var subdistid = $('#subdistid').val();

        getDistrict(provid, distid);
        getSubDistrict(provid, distid, subdistid);
        chkGender();

    });

    function chkGender(){
        var gender = '<?php echo  $teacher->gender; ?>'

        if( gender == 'M'){
            $('input:radio[name = gender][value = M]').attr('checked', true);
        }else {
            $('input:radio[name = gender][value = F]').attr('checked', true);
        }
    }

    function getDistrict(prov_id, distid) {
        var select = $("#district_id");
        select.empty();

        if(distid == "") {
            var select = $("#district_id");
            select.empty();
            select.append($('<option/>', {
                value: 0,
                text: "กรุณาเลือกเขต/อำเภอ"
            }));
        }

        $.ajax({
            type: 'GET',
            url: "{{ url('/districts') }}",
            data: { prov_id: prov_id },
            dataType: 'json',
            success: function (data) {

                $.each(data, function (index, dist_data) {
                    if(distid == dist_data.district_id) {
                        select.append($('<option/>', {
                            value: dist_data.district_id,
                            text: dist_data.district_name,
                            selected: true
                        }));
                    }
                    else {
                        select.append($('<option/>', {
                            value: dist_data.district_id,
                            text: dist_data.district_name,
                        }));
                    }
                });
            }
        });
    }

    function getSubDistrict(prov_id, dist_id, sub_dist_id) {

        $.ajax({
            type: 'GET',
            url: "{{ url('/sub_districts') }}",
            data: { prov_id: prov_id, dist_id: dist_id },
            dataType: 'json',
            success: function (data) {
                var select = $("#sub_district_id");
                select.empty();
                $.each(data, function (index, sub_dist_data) {
                    if(sub_dist_id.trim() == sub_dist_data.sub_district_id) {
                        select.append($('<option/>', {
                            value: sub_dist_data.sub_district_id,
                            text: sub_dist_data.sub_district_name,
                            selected: true
                        }));
                    }
                    else {
                        select.append($('<option/>', {
                            value: sub_dist_data.sub_district_id,
                            text: sub_dist_data.sub_district_name
                        }));
                    }
                });
            }
        });
    }

    $("#province_id").change(function () { //$("#elementId :selected").text();
        var prov_id = $('#province_id :selected').val();

        var select = $("#sub_district_id");
        select.empty();
        select.append($('<option/>', {
            value: 0,
            text: "กรุณาเลือกแขวง/ตำบล"
        }));

        getDistrict(prov_id, "");
    });

    $("#district_id").change(function () {
        var prov_id = $('#province_id :selected').val();
        var dist_id = $('#district_id :selected').val();

        getSubDistrict(prov_id, dist_id, "");
    })

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
