<script type="text/javascript">
$(document).ready(function () {
    toastr.options = {
        "debug": false,
        "positionClass": "toast-bottom-right",
        "onclick": null,
        "fadeIn": 300,
        "fadeOut": 100,
        "timeOut": 5000,
        "extendedTimeOut": 1000
    }

    $('#tablePayroll').dataTable( {
        "language": {
            "search": "ค้นหาชื่อครู:"
        },
        "columnDefs": [
            { "searchable": false, "targets": [1, 2, 3, 4, 5, 6] }
        ]
    });
});

function createPayroll(cs_id, teacher_id, hire) {
    $.ajax({
        type: 'POST',
        url: "{{ url('/createPayroll') }}",
        data: { course_schedule_id: cs_id, teacher_id: teacher_id, hire: hire,
                 _token: "{{ csrf_token() }}" },
        dataType: 'json',
        success: function(data) {
            //console.log(data);
            if(data.resp == true) {
                toastr.info(data.text, "ข้อมูลค่าจ้างสอน");

                // Set delay time 3 sec before reload page.
                setTimeout(function(){
                    location.reload();
                },2000);
            }
            else {
                toastr.error(data.text, "ข้อมูลค่าจ้างสอน");
            }
        }
    });
}
</script>

@yield('scripts-extra')
