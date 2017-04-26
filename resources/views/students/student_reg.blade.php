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
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">ข้อมูลผู้สมัคร</h3>
			</div>
			<div class="panel-body">
				<form action="{{ url('/student') }}" method="post">
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

				</br>

				<div class="row">
					<span class="col-sm-2 col-md-2 text-right">ชื่อ </span>
					<div class="col-sm-4 col-md-4 text-right">
						<div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
							<input type="text" name="firstname" class="form-control"placeholder="กรุณาระบุชื่อ" value="{{ old('firstname') }}">

						</div>
					</div>
					<span class="col-sm-2 col-md-2 text-right">นามสกุล </span>
					<div class="col-sm-4 col-md-4 text-right">
						<div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
							<input type="text" name="lastname" class="form-control"
							placeholder="กรุณาระบุนามสกุล" value="{{ old('lastname') }}">

						</div>
					</div>
				</div>
				<div class="row">
					<span class="col-sm-2 col-md-2 text-right">ชื่อเล่น</span>
					<div class="col-sm-10 col-md-4 text-left">
						<div class="form-group {{ $errors->has('nickname') ? 'has-error' : '' }}">
							<input type="text" name="nickname" class="form-control"
							placeholder="กรุณาระบุชื่อเล่น" value="{{ old('nickname') }}">

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
					<div class="col-sm-11 col-md-3 text-center"> <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
						<label class="radio-inline"> <input type="radio" name="optradio">&nbsp;&nbsp;ชาย &nbsp;&nbsp;&nbsp;
						</label>
						<label class="radio-inline">
							<input type="radio" name="optradio">  หญิง&nbsp;&nbsp;&nbsp;
						</label></div>
					</div>
				</div>
				<br>
				<div class="row"><span class="col-sm-2 col-md-2 text-right">ชื่อสถานศึกษา</span>
					<div class="col-sm-4 col-md-4 text-center"> <div class="form-group {{ $errors->has('schoolname') ? 'has-error' : '' }}">
						<input type='text' name="schoolname" class="form-control text-left" placeholder="กรุณาระบุชื่อสถานศึกษา" value="{{ old('schoolname') }}" /></div></div>
						<div class="col-sm-2 col-md-2 text-right">จังหวัด</div>
						<div class="col-sm-4 col-md-4 text-center">
							<input list="opts_province" name="province_list"
                                class="form-control"
                                placeholder="กรุณาระบุจังหวัด">
                            <datalist id="opts_province">
                                @foreach($prov as $prov_list)
                                    <option id="{{ $prov_list->province_id }}"
                                        value="{{ $prov_list->province_name }}">
                                    </option>
                                @endforeach
                            </datalist>
                            <input type="hidden" id="province_id" name="province_id">
							</div>
						</div>

						<div class="row">
							<span class="col-sm-2 col-md-2 text-right">ชั้นประถมศึกษาปีที่ </span>
							<div class="col-sm-4 col-md-4 text-center"> <div class="form-group {{ $errors->has('school_level') ? 'has-error' : '' }}">
								<input type="text" class="form-control" placeholder="กรุณาระบุชั้นประถมศึกษาปีที่" value="{{ old('school_level') }}">
							</div></div>
						</div>
						<div class="row"><span class="col-sm-2 col-md-2 text-right">ชื่อผู้ปกครอง  </span>
							<div class="col-sm-4 col-md-4 text-center">
								<div class="form-group {{ $errors->has('parent_fname') ? 'has-error' : '' }}">
									<input type="text"  class="form-control" placeholder="กรุณาระบุชื่อผู้ปกครอง" value="{{ old('parent_fname') }}">
								</div>
							</div>

							<span class="col-sm-2 col-md-2 text-right">นามสกุล </span>

							<div class="col-sm-4 col-md-4 text-center"><div class="form-group {{ $errors->has('parent_lname') ? 'has-error' : '' }}">
								<input type="text"  class="form-control" placeholder="กรุณาระบุนามสกุลผู้ปกครอง" value="{{ old('parent_lname') }}">
							</div>
						</div>
					</div>
					<div class="row"><span class="col-sm-2 col-md-2 text-right">ความสัมพันธ์กับนักเรียน</span>
						<div class="col-sm-4 col-md-4 text-center"> <div class="form-group {{ $errors->has('student_relationship') ? 'has-error' : '' }}">

							<input type="text"  class="form-control" placeholder="กรุณาระบุความสัมพันธ์กับนักเรียน" value="{{ old('student_relationship') }}">
						</div>
					</div></div>
					<div class="row"><span class="col-sm-2 col-md-2 text-right">วันเดือนปีเกิด</span>
						<div class="col-sm-4 col-md-4 text-left">
							<div class="form-group {{ $errors->has('parent_birthdate') ? 'has-error' : '' }}">

								<div  class="input-group date datepicker" data-date-format="yyyy-mm-dd">
									<input class="form-control" type="text" name="std_birthdate" readonly />
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
									</span>
								</div>
							</div>
						</div>


						<span class="col-sm-2 col-md-2 text-right">อาชีพ</span>
						<div class="col-sm-4 col-md-4 text-center"> <div class="form-group {{ $errors->has('parent_occupation') ? 'has-error' : '' }}">
							<input type='text' class="form-control" name="parent_occupation" placeholder="กรุณาระบุอาชีพ" value="{{ old('parent_occupation') }}"  /></div>
						</div></div>

						<div class="row"><span class="col-sm-2 col-md-2 text-right">บ้านเลขที่</span>
							<div class="col-sm-4 col-md-4 text-left"><div class="form-group {{ $errors->has('addr') ? 'has-error' : '' }}">
								<input type='text' class="form-control" name="addr" placeholder="กรุณาระบุบ้านเลขที่" value="{{ old('addr') }}" /></div>
							</div>

							<span class="col-sm-2 col-md-2 text-right">ซอย</span>
							<div class="col-sm-4 col-md-4 text-center">
								<input type='text' class="form-control"  /></div>
							</div>
							<div class="row"><span class="col-sm-2 col-md-2 text-right">ถนน</span>
								<div class="col-sm-4 col-md-4 text-left">
									<input type='text' class="form-control"  />
								</div>

								<span class="col-sm-2 col-md-2 text-right">จังหวัด</span>
								<div class="col-sm-4 col-md-4 text-center">
									<div class="form-group {{ $errors->has('province_id') ? 'has-error' : '' }}">
										<select class="form-control" ></select>
									</div>
								</div>

							</div>

							<div class="row">
								<span class="col-sm-2 col-md-2 text-right">เขต/อำเภอ</span>
								<div class="col-sm-4 col-md-4 text-left">
									<div class="form-group {{ $errors->has('teacher_lname') ? 'has-error' : '' }}">
									<select class="form-control">
								</select></div>
								<!--	<input list="opts_district" name="district_list"
								class="form-control"
								placeholder="กรุณาระบุเขต/อำเภอ"
								onclick="chkProvinceInput();">
								<datalist id="opts_district">
								</datalist>
								<input type="hidden" id="district_id" name="district_id">-->
							</div>
							<span class="col-sm-2 col-md-2 text-right">ตำบล/แขวง</span>
							<div class="col-sm-4 col-md-4 text-center">
								<select class="form-control">
							</select>
							<!--<input list="opts_sub_district" name="sub_district_list"
							class="form-control"
							placeholder="กรุณาระบุแขวง/ตำบล"
							onclick="chkDistrictInput();">
							<datalist id="opts_sub_district">
							</datalist>
							<input type="hidden" id="sub_district_id" name="sub_district_id">-->
						</div>
					</div>

					<div class="row"><span class="col-sm-2 col-md-2 text-right">รหัสไปรษณีย์</span>
						<div class="col-sm-4 col-md-4 text-left"><div class="form-group {{ $errors->has('postcode') ? 'has-error' : '' }}">
							<input type='text' class="form-control" name="postcode" placeholder="กรุณาระบุรหัสไปรษณีย์" value="{{ old('postcode') }}"  /></div>
						</div>

						<span class="col-sm-2 col-md-2 text-right">อีเมล</span>
						<div class="col-sm-4 col-md-4 text-center"><div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							<input type='text' class="form-control" name="email" placeholder="กรุณาระบุอีเมล์" value="{{ old('email') }}"  /></div>
						</div>
					</div>
					<div class="row"><span class="col-sm-2 col-md-2 text-right">เบอร์โทรศัพท์</span>
						<div class="col-sm-4 col-md-4 text-left"><div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
							<input type='text' class="form-control" name="mobile" placeholder="กรุณาระบุเบอร์โทรศัพท์" value="{{ old('mobile') }}"  /></div>
						</div>

						<span class="col-sm-2 col-md-2 text-right">เบอร์บ้าน</span>
						<div class="col-sm-4 col-md-4 text-center">
							<div class="form-group {{ $errors->has('tel') ? 'has-error' : '' }}">
								<input type='text' class="form-control phone"  name="tel" placeholder="กรุณาระบุเบอร์บ้าน" value="{{ old('tel') }}"  />
							</div>
						</div>
					</div>
						<br><br>
						<div class="row">
							<div class="col-sm-12 col-md-12"></div>
							<div class="col-sm-12 col-md-12 text-center">
								<button type="submit" class="btn btn-primary">บันทีก</button>
								<button type="submit" class="btn">รีเซ็ต</button>
							</div>
						</div>

				</form>	</div>
			</div>
			</div>
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
	};

	</script>
	@endsection
