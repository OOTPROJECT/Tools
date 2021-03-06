@extends('layouts.app')

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
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">ข้อมูลผู้สมัคร</h3>
			</div>
			<div class="panel-body">
				<form action="{{ url('/createStudent') }}" method="post">
					{!! csrf_field() !!}
					@if(count($errors))
					<div class="alert alert-danger">
						<strong>ไม่สามารถบันทึกข้อมูลได้ </strong> เนื่องจากกรอกข้อมูลไม่ครบถ้วน
						<br/>
						<ul>
							@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif

				</br>

				<div class="row">
					<span class="col-sm-2 col-md-2 text-right">ชื่อ </span>
					<div class="col-sm-4 col-md-4 text-left">
						<div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
							<input type="text" name="firstname" class="form-control"placeholder="กรุณาระบุชื่อ" value="{{ old('firstname') }}">
							<span class="text-danger">{{ $errors->first('firstname') }}</span>
						</div>
					</div>
					<span class="col-sm-2 col-md-2 text-right">นามสกุล </span>
					<div class="col-sm-4 col-md-4 text-left">
						<div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
							<input type="text" name="lastname" class="form-control"
							placeholder="กรุณาระบุนามสกุล" value="{{ old('lastname') }}">
							<span class="text-danger">{{ $errors->first('lastname') }}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<span class="col-sm-2 col-md-2 text-right">ชื่อเล่น</span>
					<div class="col-sm-10 col-md-4 text-left">
						<div class="form-group {{ $errors->has('nickname') ? 'has-error' : '' }}">
							<input type="text" name="nickname" class="form-control"
							placeholder="กรุณาระบุชื่อเล่น" value="{{ old('nickname') }}">
							<span class="text-danger">{{ $errors->first('nickname') }}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<span class="col-sm-2 col-md-2 text-right">วันเดือนปีเกิด</span>
					<div class="col-sm-10 col-md-4 text-left">
						<div class="form-group {{ $errors->has('std_birthdate') ? 'has-error' : '' }}">
							<div class="input-group date datepicker" data-date-format="yyyy-mm-dd">
								<input class="form-control" type="text" name="std_birthdate" readonly />
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-calendar"></i>
								</span>
							</div>

						</div>
					</div>


				</div><br>
				<div class="row"><span class="col-sm-2 col-md-2 text-right">เพศ</span>
					<div class="col-sm-11 col-md-3 text-left">
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
						<input type='text' name="schoolname" class="form-control text-left" placeholder="กรุณาระบุชื่อสถานศึกษา" value="{{ old('schoolname') }}" />
					</div>
				</div>
				<div class="col-sm-2 col-md-2 text-right">จังหวัด
				</div>
				<div class="col-sm-4 col-md-4 text-left">
					<select class="form-control" id="school_province_id" name="school_province_id">
						<option value="none">กรุณาเลือก จังหวัด</option>
						@foreach($prov as $prov_list)
							<option value="{{ $prov_list->province_id }}">
								{{ $prov_list->province_name }}
							</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="row">
				<span class="col-sm-2 col-md-2 text-right">ชั้นประถมศึกษาปีที่ </span>
				<div class="col-sm-4 col-md-4 text-left">
					<div class="form-group {{ $errors->has('school_level') ? 'has-error' : '' }}">
						<input type="text" name="school_level" class="form-control" placeholder="กรุณาระบุชั้นประถมศึกษาปีที่" value="{{ old('school_level') }}" 	maxlength="1" onKeyUp="inputschoollevel(this)"; >
						<span class="text-danger">{{ $errors->first('school_level') }}</span>
					</div>
				</div>
			</div>
			<div class="row">
				<span class="col-sm-2 col-md-2 text-right">ชื่อผู้ปกครอง  </span>
				<div class="col-sm-4 col-md-4 text-left">
					<div class="form-group {{ $errors->has('parent_fname') ? 'has-error' : '' }}">
						<input type="text" name="parent_fname"  class="form-control" placeholder="กรุณาระบุชื่อผู้ปกครอง" value="{{ old('parent_fname') }}">
						<span class="text-danger">{{ $errors->first('parent_fname') }}</span>
					</div>
				</div>

				<span class="col-sm-2 col-md-2 text-right">นามสกุล </span>

				<div class="col-sm-4 col-md-4 text-left">
					<div class="form-group {{ $errors->has('parent_lname') ? 'has-error' : '' }}">

						<input type="text" name="parent_lname" class="form-control" placeholder="กรุณาระบุนามสกุลผู้ปกครอง" value="{{ old('parent_lname') }}">
						<span class="text-danger">{{ $errors->first('parent_lname') }}</span>
					</div>
				</div>
			</div>
			<div class="row"><span class="col-sm-2 col-md-2 text-right">ความสัมพันธ์กับนักเรียน</span>
				<div class="col-sm-4 col-md-4 text-left">
					<div class="form-group {{ $errors->has('student_relationship') ? 'has-error' : '' }}">

						<input type="text" name="student_relationship"  class="form-control" placeholder="กรุณาระบุความสัมพันธ์กับนักเรียน" value="{{ old('student_relationship') }}">
						<span class="text-danger">{{ $errors->first('student_relationship') }}</span>
					</div>
				</div>
			</div>
			<div class="row">
				<span class="col-sm-2 col-md-2 text-right">วันเดือนปีเกิด</span>
				<div class="col-sm-4 col-md-4 text-left">
					<div class="form-group {{ $errors->has('parent_birthdate') ? 'has-error' : '' }}">

						<div  class="input-group date datepicker" data-date-format="yyyy-mm-dd">
							<input class="form-control" type="text" name="parent_birthdate" readonly />
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-calendar"></i>
							</span>
						</div>
					</div>
				</div>


				<span class="col-sm-2 col-md-2 text-right">อาชีพ
				</span>
				<div class="col-sm-4 col-md-4 text-left">
					<div class="form-group {{ $errors->has('parent_occupation') ? 'has-error' : '' }}">
						<input type='text' class="form-control" name="parent_occupation" placeholder="กรุณาระบุอาชีพ" value="{{ old('parent_occupation') }}"  />
					</div>
					<span class="text-danger">{{ $errors->first('parent_occupation') }}</span>
				</div>
			</div>

			<div class="row"><span class="col-sm-2 col-md-2 text-right">บ้านเลขที่</span>
				<div class="col-sm-4 col-md-4 text-left">
					<div class="form-group {{ $errors->has('addr') ? 'has-error' : '' }}">
						<input type='text' class="form-control" name="addr" placeholder="กรุณาระบุบ้านเลขที่" value="{{ old('addr') }}" />
						<span class="text-danger">{{ $errors->first('addr') }}</span>
					</div>

				</div>
				<span class="col-sm-2 col-md-2 text-right">ซอย</span>
				<div class="col-sm-4 col-md-4 text-left">
					<input type='text' class="form-control" name="soi"  />
				</div>
			</div>
			<div class="row">
				<span class="col-sm-2 col-md-2 text-right">ถนน</span>
				<div class="col-sm-4 col-md-4 text-left">
					<input type='text' class="form-control" name="road"  />
				</div>
				<span class="col-sm-2 col-md-2 text-right">จังหวัด</span>
				<div class="col-sm-4 col-md-4 text-left">
					<select class="form-control" id="province_id" name="province_id">
						<option value="none">กรุณาเลือก จังหวัด</option>
						@foreach($prov as $prov_list)
							<option value="{{ $prov_list->province_id }}">
								{{ $prov_list->province_name }}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			<br>

			<div class="row">
				<span class="col-sm-2 col-md-2 text-right">เขต/อำเภอ</span>
				<div class="col-sm-4 col-md-4 text-left">
					<select class="form-control" id="district_id" name="district_id">
						<option value="none">กรุณาเลือก เขต/อำเภอ</option>
					</select>
				</div>

				<span class="col-sm-2 col-md-2 text-right">ตำบล/แขวง</span>
				<div class="col-sm-4 col-md-4 text-left">
					<select class="form-control" id="sub_district_id" name="sub_district_id">
						<option value="none">กรุณาเลือก แขวง/ตำบล</option>
					</select>
				</div>
			</div>
			<br>

			<div class="row"><span class="col-sm-2 col-md-2 text-right">รหัสไปรษณีย์</span>
				<div class="col-sm-4 col-md-4 text-left">
					<div class="form-group {{ $errors->has('postcode') ? 'has-error' : '' }}">
						<input type='text' class="form-control" name="postcode"
						placeholder="กรุณาระบุรหัสไปรษณีย์" value="{{ old('postcode') }}"
						maxlength="5" onclick="chkSubDistrictInput();"
						 onKeyUp="inputDigits(this);"/><span class="text-danger">{{ $errors->first('postcode') }}</span>
					</div>

				</div>

				<span class="col-sm-2 col-md-2 text-right">อีเมล</span>
				<div class="col-sm-4 col-md-4 text-left">
					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						<input type='text' class="form-control" name="email"
						placeholder="กรุณาระบุอีเมล์" value="{{ old('email') }}"
						maxlength="100"/>
						<span class="text-danger">{{ $errors->first('email') }}</span>
					</div>
				</div>
			</div>
			<div class="row"><span class="col-sm-2 col-md-2 text-right">เบอร์โทรศัพท์</span>
				<div class="col-sm-4 col-md-4 text-left">
					<div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">

						<input type='text' class="form-control" name="mobile"
						placeholder="กรุณาระบุเบอร์โทรศัพท์" value="{{ old('mobile') }}"
						maxlength="10" onKeyUp="inputDigitsMobile(this);"/>
						<span class="text-danger">{{ $errors->first('mobile') }}</span>
					</div>

				</div>

				<span class="col-sm-2 col-md-2 text-right">เบอร์บ้าน</span>
				<div class="col-sm-4 col-md-4 text-left">
					<div class="form-group {{ $errors->has('tel') ? 'has-error' : '' }}">
						<input type='text' class="form-control phone"
						name="tel" placeholder="กรุณาระบุเบอร์บ้าน" value="{{ old('tel') }}"
						maxlength="9" onKeyUp="inputDigitsTel(this);" />
						<span class="text-danger">{{ $errors->first('tel') }}</span>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12 col-md-12 text-center">
					<button type="submit" class="btn btn-primary">บันทีก</button>
					<button type="submit" class="btn">ยกเลิก</button>
				</div>
			</div>

		</form>
	</div>
</div>
</div>
</div>


<script type="text/javascript">

$("#province_id").change(function () {
	var prov_id = $('#province_id :selected').val();

	var select = $("#district_id");
	select.empty();

	var select_sub_dist = $("#sub_district_id");
	select_sub_dist.empty();
	select_sub_dist.append($('<option/>', {
		value: "none",
		text: "กรุณาเลือก แขวง/ตำบล"
	}));

	$.ajax({
		type: 'GET',
		url: "{{ url('/districts') }}",
		data: { prov_id: prov_id },
		dataType: 'json',
		success: function (data) {
			select.append($('<option/>', {
				value: "none",
				text: "กรุณาเลือก เขต/อำเภอ"
			}));
			$.each(data, function (index, dist_data) {
				select.append($('<option/>', {
					value: dist_data.district_id,
					text: dist_data.district_name,
				}));
			});
		}
	});
});



$("#district_id").change(function () {
	var prov_id = $('#province_id :selected').val();
	var dist_id = $('#district_id :selected').val();

	$.ajax({
		type: 'GET',
		url: "{{ url('/sub_districts') }}",
		data: { prov_id: prov_id, dist_id: dist_id },
		dataType: 'json',
		success: function (data) {
			var select = $("#sub_district_id");
			select.empty();
			$.each(data, function (index, sub_dist_data) {
				select.append($('<option/>', {
					value: sub_dist_data.sub_district_id,
					text: sub_dist_data.sub_district_name
				}));
			});
		}
	});
});



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



function inputschoollevel(sensor){
	var regExp = /[1-6]$/;
	if(!regExp.test(sensor.value)){
		$( "#school_level span.text-danger" ).text("กรุณาระบุเฉพาะตัวเลข 1-6");
		$('#school_level span').css('display', 'block');
		sensor.value = sensor.value.substring(0, sensor.value.length -1);
	}
	else {
		$('#school_level span').css('display', 'none');
	}
}





</script>
@endsection
