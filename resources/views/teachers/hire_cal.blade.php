@extends('layouts.app')
@extends('layouts.partials.scripts')

@section('htmlheader_title')
คำนวณค่าจ้างครู
@endsection

@section('contentheader_title')
คำนวณค่าจ้างครูผู้สอน
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
                    <h3 class="panel-title"></h3>
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
                        <span class="col-sm-2 col-md-2 text-right">เดือน:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <select class="form-control" id="degree" name="degree">
                                @foreach($month as $month_key => $month_val)
                                <option value="{{ $month_val }}">
                                    {{ $month_val }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <span class="col-sm-2 col-md-2 text-right">ปี:</span>
                        <div class="col-sm-4 col-md-4 text-left">
                            <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
                                <input type="text" name="lastname" class="form-control"
                                placeholder="" value="{{ old('lastname') }}">
                                <span class="text-danger">{{ $errors->first('lastname') }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>

    </div>
    <!-- /.box-body -->
</div>

<script type="text/javascript">
$(document).ready(function(){
    //alert("Hi!");
    $('input[name=chooseOption]').on('input',function() {
        var selectedOption = $('option[value="'+$(this).val()+'"]');
        if(selectedOption.length) {
            alert(selectedOption.attr('id'));
        }
        else {
             ///
             //test
            //$('input[name=chooseOption]').val("");
            //alert(0);
        }
        //alert(selectedOption.length ? selectedOption.attr('id') : 'This opiton is not in the list!');
    });
});
</script>

@endsection
