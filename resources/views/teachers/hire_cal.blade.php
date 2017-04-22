@extends('layouts.app')
@extends('layouts.partials.scripts')

@section('htmlheader_title')
คำนวณค่าจ้างครู
@endsection

@section('contentheader_title')
คำนวณค่าจ้างครู
@endsection

@section('main-content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div>
    <div class="box-body">
        <input list="options" name="chooseOption">
<datalist id="options">
  <option id="1" value="Foo">
  <option id="2" value="Bar">
  <option id="3" value="Foo">
</datalist>

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
        else { //test
            //$('input[name=chooseOption]').val("");
            //alert(0);
        }
        //alert(selectedOption.length ? selectedOption.attr('id') : 'This opiton is not in the list!');
    });
});
</script>

@endsection
