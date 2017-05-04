<script type="text/javascript">
/*Create table*/
$(document).ready(function() {

    toastr.options = {
        "debug": false,
        "positionClass": "toast-bottom-right",
        "onclick": null,
        "fadeIn": 300,
        "fadeOut": 100,
        "timeOut": 5000,
        "extendedTimeOut": 1000
    }

    $('table.hover').DataTable({
        "paging":   false,
        "info":     false,
        "filter": false
        //"dom": '<"toolbar">frtip'
    });
    $('#std_id').keyup( function() {
        table.hover.draw();
    } );
    //$("div.toolbar").html('<b>ใส่รหัสนักเรียน</b>');
    $('table.display').DataTable({
        "info":     false,
        "paging":   false,
        "filter": false,
        "autoWidth" : false
    });
    //$create table tableClassMgt
    $('#tableClassMgt').DataTable();

} );


//Show Searched Student
function showStudent(){
    var student_fname = $('#std_fname').val();
    var student_lname = $('#std_lname').val();
    console.log(student_fname);
    console.log(student_lname);
    $("#span-name").hide();
    $("#span-lname").hide();
    $("#showCourse").hide();
    $("#showStudent").hide();
    $('#tableStudentBody').empty();

    if((student_fname.length == 0) && (student_lname.length == 0)){
            $("#span-name").show();
                $("#span-lname").show();
        }else if(student_lname.length == 0){
            $("#span-lname").show();
        }else if(student_fname.length == 0){
            $("#span-name").show();
    }else{
    //clear table
    $("#span-name").hide();
    $("#span-lname").hide();
    $("#showCourse").hide();
    $("#showStudent").hide();
    $('#tableStudentBody').empty();

    //get data
    $.ajax({
        type: 'GET',
        url: "{{ url('/getStudentInfo') }}",
        data: { student_fname: student_fname , student_lname:student_lname},
        dataType: 'json',
        success: function (data) { console.log(data.length);
            if(data.length > 0) {
                $.each(data, function(index, arr_student) {
                    var $tr = $('<tr>').append(
                        $('<td class="text-center">').text(arr_student.student_id),
                        $('<td class="text-center">').text(arr_student.firstname),
                        $('<td class="text-center">').text(arr_student.lastname),
                        $('<td class="text-center">').text(arr_student.school_level),
                        $('<input type="hidden" id="std_id">').val(arr_student.student_id)
                    ).appendTo('#tableStudent');
                });
                $("#showCourse").show();
            }
            else {
                var $tr = $('<tr>').append(
                    $('<td colspan="2" class="col-sm-4 col-md-5 text-center">').text("ไม่มีนักเรียน")
                ).appendTo('#tableStudent');
            }
        }
    });
    $("#showStudent").show();

}
}
//Show list course
function selectSubject() {
    var subject_id = $('#subject_list option:selected').val();
    console.log(subject_id);
    //clear table
    $("#tableCourseBody").hide();
    $('#tableCourseBody2').empty();
    // Replace space with %20
    //room_name=room_name.trim().replace(/ /g, '%20');
    if(subject_id == "--เลือกวิชา--"){
        $("#tableCourseBody").show();
    }else{

    $.ajax({
        type: 'GET',
        url: "{{ url('/getCourseBySubject') }}",
        data: { subject_id: subject_id},
        dataType: 'json',
        success: function (data) { console.log(data.length);
            if(data.length > 0) {
                $.each(data, function(index, course_schedule) {
                    var $tr = $('<tr>').append(
                        $('<td class="text-center">').text(course_schedule.course_schedule_id),
                        $('<td class="text-center">').text(course_schedule.course_name),
                        $('<td class="text-center">').text(course_schedule.day),
                        $('<td class="text-center">').text(course_schedule.start_time+"-"+course_schedule.end_time+" น."),
                        /*$('<td class="text-center">').text(course_schedule.end_time),*/
                        $('<td class="text-center">').text(course_schedule.room_name),
                        $('<td class="text-center">').text(course_schedule.start_date),
                        $('<td class="text-center">').text(course_schedule.end_date),
                        $('<td class="text-center">').text(course_schedule.price),
                        $('<td class="text-center">').text(course_schedule.number_of_time),
                        $('<td class="text-center">').text(course_schedule.status),
                        $('<td><button type="button" class="btn btn-success" onclick="enrollCourse('+course_schedule.course_schedule_id+');">ซื้อ</button>')//,
                        //$('<td class="text-center"><input type="radio">'),
                        //$('<input type="hidden" id="cs_id">').val(course_schedule.course_schedule_id)
                    ).appendTo('#tableCourseBody2');
                });
            }
            else {
                var $tr = $('<tr>').append(
                    $('<td colspan="2" class="col-sm-4 col-md-5 text-center">').text("ไม่มีช่วงเวลาเรียนว่าง")
                ).appendTo('#tableCourseBody2');
            }
        }
    });
    }
}
function enrollCourse(cs_id){
    //alert($('#std_id').val());
    //alert(cs_id);
    //var cs_id = tableCourse.$('input, select').serialize();
    var std_id = $('#std_id').val();
    //var cs_id = $('#cs_id').val();
    console.log(std_id);
    console.log(cs_id);

    //get data
    $.ajax({
        type: 'GET',
        url: "{{ url('/createEnroll') }}",
        data: {course_schedule_id: cs_id, student_id: std_id,  _token: "{{ csrf_token() }}"},
        dataType: 'json',
        success: function (data) { console.log(data.length);
            //console.log(data);
            if(data.resp == true) {
                toastr.info(data.text, "ลงทะเบียนสำเร็จ");

                // Set delay time 3 sec before reload page.
                setTimeout(function(){
                    location.reload();
                },2000);
            }
            else {
                toastr.error(data.text, "ลงทะเบียนไม่สำเร็จ");
                }

            }
    });

}


</script>
@yield('scripts-extra')
