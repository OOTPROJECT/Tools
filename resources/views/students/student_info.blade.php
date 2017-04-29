@extends('layouts.app')
@extends('layouts.partials.scripts')
@section('htmlheader_title')
รายชื่อนักเรียน
@endsection

@section('contentheader_title')
รายชื่อนักเรียน
@endsection

@section('main-content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div>
    <div class="box-body">


<table id="example" >
    <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>ชื่อ</th>
            <th>นามสกุล</th>
            <th>รหัสประจำตัวประชาชน</th>
            <th>เพศ</th>
            <th>เบอร์โทรศัพท์</th>
            <th>อีเมล์</th>
            <th></th>
        </tr>
    </thead>
       <tbody>
           <tr>
               <td>Tiger Nixon</td>
               <td>System Architect</td>
               <td>Edinburgh</td>
               <td>61</td>
               <td>2011/04/25</td>
               <td>$320,800</td>
           </tr>
       </tbody></table>
                                </div>
                                <!-- /.box-body -->
                            </div>

                            @endsection
