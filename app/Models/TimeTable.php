<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    // Table name
    protected $table = 'time_table';

    function getTimeTable($start_date, $end_date) {
        $arr_time_table = \DB::select(
                            "SELECT room_name, day, start_time, end_time
                            FROM time_table WHERE time_table_id NOT IN
                            ( SELECT * FROM ( SELECT time_table_id FROM course_schedule
                            WHERE '2017-04-24' <= end_date AND '2017-05-23' >= start_date
                            ) AS subquery )"
                          );

        return $arr_time_table;
    }
}
