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
					<div class="row">
						<div class="col-sm-8 col-md-8"></div>
						<div class="col-sm-2 col-md-2 text-right">รหัสนักเรียน:</div>
						<div class="col-sm-2 col-md-2 text-left">
							<div class="form-group {{ $errors->has('std_code') ? 'has-error' : '' }}">
								<input type="text" name="std_code" class="form-control" placeholder="">
								<span class="text-danger">{{ $errors->first('std_code') }}</span>
							</div>
						</div>
					</div></br>
					<div class="row">
						<div class="col-sm-1 col-md-1 text-right">วันที่:</div>
						<div class="col-sm-3 col-md-3">
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
						<div class="col-sm-1 col-md-1 text-right">Login:</div>
						<div class="col-sm-3 col-md-3 text-left">
							<div class="form-group {{ $errors->has('std_username') ? 'has-error' : '' }}">
								<input type="text" name="std_username" class="form-control"
								placeholder="ไม่เกิน 8 ตัวต้องเป็น a-z, A-Z, 0-9">
								<span class="text-danger">{{ $errors->first('std_username') }}</span>
							</div>
						</div>
						<div class="col-sm-1 col-md-1 text-right">Password:</div>
						<div class="col-sm-3 col-md-3 text-left">
							<div class="form-group {{ $errors->has('std_password') ? 'has-error' : '' }}">
								<input type="text" name="std_password" class="form-control"
								placeholder="ไม่เกิน 6 ตัวต้องเป็น a-z, A-Z, 0-9">
								<span class="text-danger">{{ $errors->first('std_password') }}</span>
							</div>
						</div>
					</div></br>
					<div class="row">
						<div class="col-sm-1 col-md-1 text-right">ชื่อ:</div>
						<div class="col-sm-3 col-md-3 text-left">
							<div class="form-group {{ $errors->has('std_fname') ? 'has-error' : '' }}">
								<input type="text" name="std_fname" class="form-control"
								placeholder="">
								<span class="text-danger">{{ $errors->first('std_fname') }}</span>
							</div>
						</div>
						<div class="col-sm-1 col-md-1 text-right">นามสกุล:</div>
						<div class="col-sm-3 col-md-3 text-left">
							<div class="form-group {{ $errors->has('std_lname') ? 'has-error' : '' }}">
								<input type="text" name="std_lname" class="form-control"
								placeholder="" value="{{ old('std_lname') }}">
								<span class="text-danger">{{ $errors->first('std_lname') }}</span>
							</div>
						</div>
						<div class="col-sm-1 col-md-1 text-right">ชื่อเล่น:</div>
						<div class="col-sm-3 col-md-3 text-left">
							<div class="form-group {{ $errors->has('std_nname') ? 'has-error' : '' }}">
								<input type="text" name="std_nname" class="form-control"
								placeholder="" value="{{ old('std_nname') }}">
								<span class="text-danger">{{ $errors->first('std_nname') }}</span>
							</div>
						</div>
					</div></br>
					<div class="row">
						<div class="col-sm-10 col-md-11"></div>
						<div class="col-sm-2 col-md-1 text-right">
							<button type="submit" class="btn btn-primary">บันทีก</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.box-body -->
</div>
@endsection
