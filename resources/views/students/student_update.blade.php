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
						<h3 class="panel-title">ข้อมูลผู้สมัคร {{ $students->firstname ." "}}  {{ $students->lastname }}</h3>
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
									<input type="text" name="firstname" class="form-control"placeholder="กรุณาระบุชื่อ" value="{{ $students->firstname}}">
									<span class="text-danger">{{ $errors->first('firstname') }}</span>
								</div>
							</div>
							<span class="col-sm-2 col-md-2 text-right">นามสกุล </span>
							<div class="col-sm-4 col-md-4 text-right">
								<div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
									<input type="text" name="lastname" class="form-control"
									placeholder="กรุณาระบุนามสกุล" value="{{ $students->lastname }}">
									<span class="text-danger">{{ $errors->first('lastname') }}</span>
								</div>
							</div>
						</div>
						<div class="row">
							<span class="col-sm-2 col-md-2 text-right">ชื่อเล่น</span>
							<div class="col-sm-10 col-md-4 text-left">
								<div class="form-group {{ $errors->has('nickname') ? 'has-error' : '' }}">
									<input type="text" name="nickname" class="form-control"
									placeholder="กรุณาระบุชื่อเล่น" value="{{ $students->nickname }}">
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
									value="{{ $students->std_birthdate}}" readonly />
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
							<input type='text' name="schoolname" class="form-control text-left" placeholder="กรุณาระบุชื่อสถานศึกษา" value="{{ $students->schoolname }}" />
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
						<input type="hidden" id="school_province_id" name="school_province_id" value="{{ $students->school_province_id }}">

					</div>
				</div>

				<div class="row">
					<span class="col-sm-2 col-md-2 text-right">ชั้นประถมศึกษาปีที่ </span>
					<div class="col-sm-4 col-md-4 text-center">
						<div class="form-group {{ $errors->has('school_level') ? 'has-error' : '' }}">
							<input type="text" name="school_level" class="form-control" placeholder="กรุณาระบุชั้นประถมศึกษาปีที่" value="{{ $students->school_level }}">
							<span class="text-danger">{{ $errors->first('school_level') }}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<span class="col-sm-2 col-md-2 text-right">ชื่อผู้ปกครอง  </span>
					<div class="col-sm-4 col-md-4 text-center">
						<div class="form-group {{ $errors->has('parent_fname') ? 'has-error' : '' }}">
							<input type="text" name="parent_fname"  class="form-control" placeholder="กรุณาระบุชื่อผู้ปกครอง" value="{{ $students->parent_fname }}">
							<span class="text-danger">{{ $errors->first('parent_fname') }}</span>
						</div>
					</div>

					<span class="col-sm-2 col-md-2 text-right">นามสกุล </span>

					<div class="col-sm-4 col-md-4 text-center">
						<div class="form-group {{ $errors->has('parent_lname') ? 'has-error' : '' }}">

							<input type="text" name="parent_lname" class="form-control" placeholder="กรุณาระบุนามสกุลผู้ปกครอง" value="{{ $students->parent_lname }}">
							<span class="text-danger">{{ $errors->first('parent_lname') }}</span>
						</div>
					</div>
				</div>
				<div class="row"><span class="col-sm-2 col-md-2 text-right">ความสัมพันธ์กับนักเรียน</span>
					<div class="col-sm-4 col-md-4 text-center">
						<div class="form-group {{ $errors->has('student_relationship') ? 'has-error' : '' }}">

							<input type="text" name="student_relationship"  class="form-control" placeholder="กรุณาระบุความสัมพันธ์กับนักเรียน" value="{{ $students->student_relationship }}">
							<span class="text-danger">{{ $errors->first('student_relationship') }}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<span class="col-sm-2 col-md-2 text-right">วันเดือนปีเกิด</span>
					<div class="col-sm-4 col-md-4 text-left">
						<div class="form-group {{ $errors->has('parent_birthdate') ? 'has-error' : '' }}">
							<div  class="input-group date datepicker" data-date-format="yyyy-mm-dd">
								<input class="form-control" type="text" name="parent_birthdate" value="{{ $students->birthdate}}" readonly />
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
							<input type='text' class="form-control" name="parent_occupation" placeholder="กรุณาระบุอาชีพ" value="{{ $students->parent_occupation') }}"  />
						</div>
						<span class="text-danger">{{ $errors->first('parent_occupation') }}</span>
					</div>
				</div>

				<div class="row"><span class="col-sm-2 col-md-2 text-right">บ้านเลขที่</span>
					<div class="col-sm-4 col-md-4 text-left">
						<div class="form-group {{ $errors->has('addr') ? 'has-error' : '' }}">
							<input type='text' class="form-control" name="addr" placeholder="กรุณาระบุบ้านเลขที่" value="{{ $students->addr }}" />
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
				<br>

				<div class="row">
					<span class="col-sm-2 col-md-2 text-right">เขต/อำเภอ</span>
					<div class="col-sm-4 col-md-4 text-left">

						<input list="opts_district" name="district_list"
						class="form-control"
						placeholder="กรุณาระบุเขต/อำเภอ"
						onclick="chkProvinceInput();">
						<datalist id="opts_district">
						</datalist>
						<input type="hidden" id="district_id" name="district_id">

					</div>

					<span class="col-sm-2 col-md-2 text-right">ตำบล/แขวง</span>
					<div class="col-sm-4 col-md-4 text-center">
						<input list="opts_sub_district" name="sub_district_list"
						class="form-control"
						placeholder="กรุณาระบุแขวง/ตำบล"
						onclick="chkDistrictInput();">
						<datalist id="opts_sub_district">
						</datalist>
						<input type="hidden" id="sub_district_id" name="sub_district_id">

					</div>
				</div>
				<br>

				<div class="row"><span class="col-sm-2 col-md-2 text-right">รหัสไปรษณีย์</span>
					<div class="col-sm-4 col-md-4 text-left">
						<div class="form-group {{ $errors->has('postcode') ? 'has-error' : '' }}">
							<input type='text' class="form-control" name="postcode" placeholder="กรุณาระบุรหัสไปรษณีย์" value="{{ $students->postcode }}"  />
						</div>
						<span class="text-danger">{{ $errors->first('postcode') }}</span>
					</div>

					<span class="col-sm-2 col-md-2 text-right">อีเมล</span>
					<div class="col-sm-4 col-md-4 text-center">
						<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							<input type='text' class="form-control" name="email" placeholder="กรุณาระบุอีเมล์" value="{{ $students->email }}"  />
						</div>
						<span class="text-danger">{{ $errors->first('email') }}</span>
					</div>
				</div>
				<div class="row"><span class="col-sm-2 col-md-2 text-right">เบอร์โทรศัพท์</span>
					<div class="col-sm-4 col-md-4 text-left">
						<div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">

							<input type='text' class="form-control" name="mobile" placeholder="กรุณาระบุเบอร์โทรศัพท์" value="{{ $students->mobile }}"  />
						</div>
						<span class="text-danger">{{ $errors->first('mobile') }}</span>
					</div>

					<span class="col-sm-2 col-md-2 text-right">เบอร์บ้าน</span>
					<div class="col-sm-4 col-md-4 text-center">
						<div class="form-group {{ $errors->has('tel') ? 'has-error' : '' }}">
							<input type='text' class="form-control phone"  name="tel" placeholder="กรุณาระบุเบอร์บ้าน" value="{{ $students->tel }}"  />
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
