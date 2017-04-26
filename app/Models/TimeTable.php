<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    // Table name
    protected $table = 'time_table';

    function getAllClassRoom() {
        $arr_all_classroom = TimeTable::select('room_name')->distinct()
                                ->orderBy('room_name')
                                ->get();

        return $arr_all_classroom;
    }

    function getTimeTable($start_date, $end_date, $room_name) {
        $arr_time_table = \DB::select(
                            "SELECT time_table_id, day, start_time, end_time
                            FROM time_table WHERE room_name = '". $room_name ."'
                            AND time_table_id NOT IN
                            ( SELECT * FROM ( SELECT time_table_id FROM course_schedule
                            WHERE '2017-04-24' <= end_date AND '2017-05-23' >= start_date
                            ) AS subquery )"
                          );

        return $arr_time_table;
    }
}
