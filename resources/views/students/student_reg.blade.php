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
					<div class="col-sm-1 col-md-1 text-center">ชื่อ </div>
					<div class="col-sm-5 col-md-5 text-center">
						<div class="form-group {{ $errors->has('std_fname') ? 'has-error' : '' }}">
							<input type="text" name="std_fname" class="form-control"
							placeholder="">
							<span class="text-danger">{{ $errors->first('std_fname') }}</span>
						</div>
					</div>
					<div class="col-sm-1 col-md-1 text-center">นามสกุล </div>
					<div class="col-sm-5 col-md-5 text-center">
						<div class="form-group {{ $errors->has('std_lname') ? 'has-error' : '' }}">
							<input type="text" name="std_lname" class="form-control"
							placeholder="" value="{{ old('std_lname') }}">
							<span class="text-danger">{{ $errors->first('std_lname') }}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-1 col-md-1 text-center">ชื่อเล่น</div>
					<div class="col-sm-11 col-md-5 text-left">
						<div class="form-group {{ $errors->has('std_nname') ? 'has-error' : '' }}">
							<input type="text" name="std_nname" class="form-control"
							placeholder="" value="{{ old('std_nname') }}">
							<span class="text-danger">{{ $errors->first('std_nname') }}</span>
						</div>
					</div>
				</div>
				<div class="row"><div class="col-sm-1 col-md-1 text-center">วันเดือนปีเกิด</div>
				<div class="col-sm-11 col-md-5 text-left">
					<input type='text' class="form-control text-center" id="datepicker"  />
				</div>


			</div><br>
			<div class="row"><div class="col-sm-1 col-md-1 text-center">เพศ</div><div class="col-sm-11 col-md-3 text-center">
				<label class="radio-inline"> <input type="radio" name="optradio">	&nbsp;&nbsp;ชาย &nbsp;&nbsp;&nbsp;
				</label>
				<label class="radio-inline">
					<input type="radio" name="optradio">  หญิง&nbsp;&nbsp;&nbsp;
				</label>
			</div></div>
			<br>
			<div class="row"><div class="col-sm-1 col-md-1 text-center">ชื่อสถานศึกษา</div><div class="col-sm-11 col-md-5 text-center">
				<input type='text' class="form-control text-center" /></div>
			<div class="col-sm-1 col-md-1 text-center">จังหวัด</div>
				<div class="col-sm-11 col-md-5 text-left">
					<select class="form-control">

     </select>
				</div>

			</div>

			<div class="row">
			<div class="col-sm-1 col-md-1 text-center">ชั้นประถมศึกษาปีที่ </div>
			<div class="col-sm-5 col-md-5 text-center">
					<input type="text" class="form-control">
				</div>
			</div>
			<div class="row"><div class="col-sm-1 col-md-1 text-center">ชื่อผู้ปกครอง </div>
			<div class="col-sm-5 col-md-5 text-center">

					<input type="text"  class="form-control">

				</div>

			<div class="col-sm-1 col-md-1 text-center">นามสกุล </div>
			<div class="col-sm-5 col-md-5 text-center">

					<input type="text"  class="form-control">
				</div>
			</div>
			<div class="row"><div class="col-sm-1 col-md-1 text-center">ความสัมพันธ์กับนักเรียน</div> <div class="col-sm-5 col-md-5 text-center">

					<input type="text"  class="form-control">

				</div></div>
				<div class="row"><div class="col-sm-1 col-md-1 text-center">วันเดือนปีเกิด</div>
				<div class="col-sm-11 col-md-5 text-left">
				<input type='text' class="form-control text-center" id="datepicker"  />
				</div>
				<div class="row"><div class="col-sm-1 col-md-1 text-center">อาชีพ</div>
				<div class="col-sm-11 col-md-5 text-left">
					<input type='text' class="form-control text-center"   />
				</div>






			<br>
				<div class="row">
					<div class="col-sm-12 col-md-12"></div>
					<div class="col-sm-12 col-md-12 text-center">
						<button type="submit" class="btn btn-primary">บันทีก</button>
						<button type="submit" class="btn">รีเซ็ต</button>
					</div>
				</div>
			</div></div>
		</form>
	</div>
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
