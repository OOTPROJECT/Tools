<script type="text/javascript">
$(document).ready(function (){

    $('#tableClassMgt').dataTable();

    var date = new Date();
    date.setDate(date.getDate() + 14);
    var end_date = date.toISOString().slice(0,10).replace(/-/g,"-");

    $("#div_enddate, .datepicker1").datepicker({
        autoclose: true,
        todayHighlight: true,
        startDate: "+14d"
    }).datepicker('update', end_date);

    $("#div_stdate, .datepicker").datepicker({
        autoclose: true,
        todayHighlight: true
    })
    .on('changeDate', function(ev) {
        var newDate = new Date(ev.date)
        newDate.setDate(newDate.getDate() + 14);

        $("#div_enddate, .datepicker1").datepicker('remove');
        $("#div_enddate, .datepicker1").datepicker({
            autoclose: true,
            todayHighlight: true,
            startDate: newDate
        }).datepicker('update', newDate);

        $("#div_time_table").hide();
    });

    $("#div_enddate, .datepicker").on('changeDate', function(ev) {
        $("#div_time_table").hide();
    });
});

$("#classroom").change(function () {
    $("#div_time_table").hide();
})

function chkTimeTable() {
    var start_date = $('input[name=start_date]').val();
    var end_date = $('input[name=end_date]').val();
    var room_name = $('#classroom option:selected').text();

    // Clear tb time table
    $("#tb_time_table > tbody").empty();

    // Replace space with %20
    room_name=room_name.trim().replace(/ /g, '%20');

    $.ajax({
        type: 'GET',
        url: "{{ url('/getTimeTable') }}",
        data: { start_date: start_date, end_date: end_date, room_name: room_name },
        dataType: 'json',
        success: function (data) {
            if(data.length > 0) {
                $.each(data, function(index, time_table) {
                    var $tr = $('<tr>').append(
                        $('<td class="col-sm-4 col-md-4 text-center">').text(time_table.day +
                            " (" + time_table.start_time
                            + " - " + time_table.end_time + " น.)"),
                        $('<td class="col-sm-3 col-md-3 text-left">').html(
                            '<button type="button" class="btn btn-success"' +
                            ' onclick="createCourseSchedule(' + time_table.time_table_id +
                            ');" tootip="เลือกและบันทึก">' +
                            ' จอง</button>')
                    ).appendTo('#tb_time_table');
                });
            }
            else {
                var $tr = $('<tr>').append(
                    $('<td colspan="2" class="col-sm-4 col-md-4 text-center">').text("ไม่มีช่วงเวลาเรียนว่าง")
                ).appendTo('#tb_time_table');
            }
        }
    });
    $("#div_time_table").show();
}

function createCourseSchedule(time_table_id) {
    var course_id = $('#course option:selected'). val();
    var teacher_id = $('#teacher option:selected').val();
    var start_date = $('input[name=start_date]').val();
    var end_date = $('input[name=end_date]').val();

    $.ajax({
        type: 'POST',
        url: "{{ url('/createCourseSchedule') }}",
        data: { course_id: course_id, teacher_id: teacher_id, time_table_id: time_table_id,
                start_date: start_date, end_date: end_date, _token: "{{ csrf_token() }}" },
        dataType: 'json',
        success: function(data) {
            console.log(data.resp);
            if(data.resp == true) {
                toastr.info(data.text, "สร้างคลาสเรียน");

                // Set delay time 3 sec before reload page.
                setTimeout(function(){
                    location.reload();
                },2000);
            }
            else {
                toastr.error(data.text, "สร้างคลาสเรียน");
            }
        }
    });

    return false;
}

function deleteCourseSchedule(cs_id) {

    $.ajax({
        type: 'get',
        url: "{{ url('/deleteCourseSchedule') }}",
        data: { cs_id: cs_id, _token: "{{ csrf_token() }}" },
        dataType: 'json',
        success: function(data) {
            //console.log(data);
            if(data.resp == true) {
                toastr.info(data.text, "จัดการคลาสเรียน");

                // Set delay time 3 sec before reload page.
                setTimeout(function(){
                    location.reload();
                },2000);
            }
            else {
                toastr.error(data.text, "จัดการคลาสเรียน");
            }
        }
    });

    return false;
}

</script>

@yield('scripts-extra')
