@extends('layouts.app')
@extends('layouts.partials.scripts')

@section('htmlheader_title')
การสมัครเรียน
@endsection

@section('contentheader_title')
การสมัครเรียน
@endsection

@section('main-content')

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title"></h3>
	</div>
	<div class="box-body">

		<div class="panel-body">
			<form action="{{ url('/updateStudent')}}/{{ $student_id }}" method="post">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">ข้อมูลผู้สมัคร {{ $student->firstname}}  {{ $student->lastname }}</h3>
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
							<span class="col-sm-2 col-md-2 text-right">ชื่อ </span>
							<div class="col-sm-4 col-md-4 text-right">
								<div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
									<input type="text" name="firstname" class="form-control"placeholder="กรุณาระบุชื่อ" value="{{ $student->firstname}}">
									<span class="text-danger">{{ $errors->first('firstname') }}</span>
								</div>
							</div>
							<span class="col-sm-2 col-md-2 text-right">นามสกุล </span>
							<div class="col-sm-4 col-md-4 text-right">
								<div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
									<input type="text" name="lastname" class="form-control"
									placeholder="กรุณาระบุนามสกุล" value="{{ $student->lastname }}">
									<span class="text-danger">{{ $errors->first('lastname') }}</span>
								</div>
							</div>
						</div>
						<div class="row">
							<span class="col-sm-2 col-md-2 text-right">ชื่อเล่น</span>
							<div class="col-sm-10 col-md-4 text-left">
								<div class="form-group {{ $errors->has('nickname') ? 'has-error' : '' }}">
									<input type="text" name="nickname" class="form-control"
									placeholder="กรุณาระบุชื่อเล่น" value="{{ $student->nickname }}">
									<span class="text-danger">{{ $errors->first('nickname') }}</span>
								</div>
							</div>
						</div>
						<div class="row">
							<span class="col-sm-2 col-md-2 text-right">วันเดือนปีเกิด</span>
							<div class="col-sm-10 col-md-4 text-left">
								<div class="form-group {{ $errors->has('std_birthdate') ? 'has-error' : '' }}">
									<div class="input-group date datepicker"
									data-date-format="yyyy-mm-dd">
									<input class="form-control" type="text" name="std_birthdate"
									value="{{ $student->std_birthdate}}" readonly />
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
									</span>
								</div>

							</div>
						</div>


					</div><br>
					<div class="row"><span class="col-sm-2 col-md-2 text-right">เพศ</span>
						<div class="col-sm-11 col-md-3 text-center">
							<div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
								<label class="radio-inline">
									<input type="radio" name="gender" value="M">&nbsp;&nbsp;ชาย &nbsp;&nbsp;&nbsp;
								</label>
								<label class="radio-inline">
									<input type="radio" name="gender" value="F">  หญิง&nbsp;&nbsp;&nbsp;
								</label>
								<span class="text-danger">{{ $errors->first('gender') }}</span>
							</div>
						</div>
					</div>
					<br>
					<div class="row"><span class="col-sm-2 col-md-2 text-right">ชื่อสถานศึกษา</span>
						<div class="col-sm-4 col-md-4 text-center"> <div class="form-group {{ $errors->has('schoolname') ? 'has-error' : '' }}">
							<input type='text' name="schoolname" class="form-control text-left" placeholder="กรุณาระบุชื่อสถานศึกษา" value="{{ $student->schoolname }}" />
						</div>
					</div>
					<div class="col-sm-2 col-md-2 text-right">จังหวัด
					</div>
					<div class="col-sm-4 col-md-4 text-center">
						<select class="form-control" id="province_id" name="province_id">
							@foreach($prov as $prov_list)
							@if($student->school_province_id == $prov_list->province_id)
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
						<input type="hidden" id="school_province_id" name="school_province_id" value="{{ $student->school_province_id }}">

					</div>
				</div>

				<div class="row">
					<span class="col-sm-2 col-md-2 text-right">ชั้นประถมศึกษาปีที่ </span>
					<div class="col-sm-4 col-md-4 text-center">
						<div class="form-group {{ $errors->has('school_level') ? 'has-error' : '' }}">
							<input type="text" name="school_level" class="form-control" placeholder="กรุณาระบุชั้นประถมศึกษาปีที่" value="{{ $student->school_level }}">
							<span class="text-danger">{{ $errors->first('school_level') }}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<span class="col-sm-2 col-md-2 text-right">ชื่อผู้ปกครอง  </span>
					<div class="col-sm-4 col-md-4 text-center">
						<div class="form-group {{ $errors->has('parent_fname') ? 'has-error' : '' }}">
							<input type="text" name="parent_fname"  class="form-control" placeholder="กรุณาระบุชื่อผู้ปกครอง" value="{{ $student->parent_fname }}">
							<span class="text-danger">{{ $errors->first('parent_fname') }}</span>
						</div>
					</div>

					<span class="col-sm-2 col-md-2 text-right">นามสกุล </span>

					<div class="col-sm-4 col-md-4 text-center">
						<div class="form-group {{ $errors->has('parent_lname') ? 'has-error' : '' }}">

							<input type="text" name="parent_lname" class="form-control" placeholder="กรุณาระบุนามสกุลผู้ปกครอง" value="{{ $student->parent_lname }}">
							<span class="text-danger">{{ $errors->first('parent_lname') }}</span>
						</div>
					</div>
				</div>
				<div class="row"><span class="col-sm-2 col-md-2 text-right">ความสัมพันธ์กับนักเรียน</span>
					<div class="col-sm-4 col-md-4 text-center">
						<div class="form-group {{ $errors->has('student_relationship') ? 'has-error' : '' }}">

							<input type="text" name="student_relationship"  class="form-control" placeholder="กรุณาระบุความสัมพันธ์กับนักเรียน" value="{{ $student->student_relationship }}">
							<span class="text-danger">{{ $errors->first('student_relationship') }}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<span class="col-sm-2 col-md-2 text-right">วันเดือนปีเกิด</span>
					<div class="col-sm-4 col-md-4 text-left">
						<div class="form-group {{ $errors->has('parent_birthdate') ? 'has-error' : '' }}">
							<div  class="input-group date datepicker" data-date-format="yyyy-mm-dd">
								<input class="form-control" type="text" name="parent_birthdate" value="{{ $student->birthdate}}" readonly />
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-calendar"></i>
								</span>
							</div>
						</div>
					</div>
					<span class="col-sm-2 col-md-2 text-right">อาชีพ
					</span>
					<div class="col-sm-4 col-md-4 text-center">
						<div class="form-group {{ $errors->has('parent_occupation') ? 'has-error' : '' }}">
							<input type='text' class="form-control" name="parent_occupation" placeholder="กรุณาระบุอาชีพ" value="{{ $student->parent_occupation }}"  />
						</div>
						<span class="text-danger">{{ $errors->first('parent_occupation') }}</span>
					</div>
				</div>

				<div class="row"><span class="col-sm-2 col-md-2 text-right">บ้านเลขที่</span>
					<div class="col-sm-4 col-md-4 text-left">
						<div class="form-group {{ $errors->has('addr') ? 'has-error' : '' }}">
							<input type='text' class="form-control" name="addr" placeholder="กรุณาระบุบ้านเลขที่" value="{{ $student->addr }}" />
						</div>
						<span class="text-danger">{{ $errors->first('addr') }}</span>
					</div>
					<span class="col-sm-2 col-md-2 text-right">ซอย</span>
					<div class="col-sm-4 col-md-4 text-center">
						<input type='text' class="form-control" name="soi"  />
					</div>
				</div>
				<div class="row">
					<span class="col-sm-2 col-md-2 text-right">ถนน</span>
					<div class="col-sm-4 col-md-4 text-left">
						<input type='text' class="form-control" name="road"  />
					</div>
					<span class="col-sm-2 col-md-2 text-right">จังหวัด</span>
					<div class="col-sm-4 col-md-4 text-center">

						<select name="province_id"
						class="form-control"
						placeholder="กรุณาระบุจังหวัด">
						<datalist id="opts_province">
							@foreach($prov as $prov_list)
								@if($student->province_id == $prov_list->province_id)
									<option value="{{ $prov_list->province_id }}" selected="true">
										{{ $prov_list->province_name }}
									</option>
								@else
									<option value="{{ $prov_list->province_id }}">
										{{ $prov_list->province_name }}
									</option>
								@endif
							@endforeach
						</datalist>
						<input type="hidden" id="provid" name="provid" value="{{ $student->province_id }}">
					</div>

				</div>
				<br>

				<div class="row">
					<span class="col-sm-2 col-md-2 text-right">เขต/อำเภอ</span>
					<div class="col-sm-4 col-md-4 text-left">

						<select class="form-control" id="district_id" name="district_id">
						</select>
						<input type="hidden" id="distid" name="distid" value="{{ $student->district_id }}">

					</div>

					<span class="col-sm-2 col-md-2 text-right">ตำบล/แขวง</span>
					<div class="col-sm-4 col-md-4 text-center">
						<select class="form-control" id="sub_district_id" name="sub_district_id">
						</select>
						<input type="hidden" id="subdistid" name="subdistid" value="{{ $student->sub_district_id }}">

					</div>
				</div>
				<br>

				<div class="row"><span class="col-sm-2 col-md-2 text-right">รหัสไปรษณีย์</span>
					<div class="col-sm-4 col-md-4 text-left">
						<div class="form-group {{ $errors->has('postcode') ? 'has-error' : '' }}">
							<input type='text' class="form-control" name="postcode" placeholder="กรุณาระบุรหัสไปรษณีย์" value="{{ $student->postcode }}"  />
						</div>
						<span class="text-danger">{{ $errors->first('postcode') }}</span>
					</div>

					<span class="col-sm-2 col-md-2 text-right">อีเมล</span>
					<div class="col-sm-4 col-md-4 text-center">
						<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							<input type='text' class="form-control" name="email" placeholder="กรุณาระบุอีเมล์" value="{{ $student->email }}"  />
						</div>
						<span class="text-danger">{{ $errors->first('email') }}</span>
					</div>
				</div>
				<div class="row"><span class="col-sm-2 col-md-2 text-right">เบอร์โทรศัพท์</span>
					<div class="col-sm-4 col-md-4 text-left">
						<div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">

							<input type='text' class="form-control" name="mobile" placeholder="กรุณาระบุเบอร์โทรศัพท์" value="{{ $student->mobile }}"  />
						</div>
						<span class="text-danger">{{ $errors->first('mobile') }}</span>
					</div>

					<span class="col-sm-2 col-md-2 text-right">เบอร์บ้าน</span>
					<div class="col-sm-4 col-md-4 text-center">
						<div class="form-group {{ $errors->has('tel') ? 'has-error' : '' }}">
							<input type='text' class="form-control phone"  name="tel" placeholder="กรุณาระบุเบอร์บ้าน" value="{{ $student->tel }}"  />
							<span class="text-danger">{{ $errors->first('tel') }}</span>
						</div>
					</div>
				</div>
				<br>
				<br>
				<div class="row">

					<div class="col-sm-12 col-md-12 text-center">
						<button type="submit" class="btn btn-primary">บันทีก</button>
						<button type="submit" class="btn">รีเซ็ต</button>
					</div>
				</div>
			</div>
		</div>
	</form>

</div>
</div>
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
        var gender = '<?php echo  $student->gender; ?>'

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
