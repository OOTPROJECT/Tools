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
        <form action="{{ url('/updateTeacher') }}" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ข้อมูลผู้สมัคร รหัสครู {{ $teacher_id }}</h3>
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
                                placeholder="" value="{{ old('firstname') }}" model="">
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

</script>
@endsection
