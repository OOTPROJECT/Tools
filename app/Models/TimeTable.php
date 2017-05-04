<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    // Table name
    protected $table = 'time_table';

    public function getAllClassRoom() {
        $arr_all_classroom = TimeTable::select('room_name')->distinct()
                                ->orderBy('room_name')
                                ->get();

        return $arr_all_classroom;
    }

    public function getTimeTable($start_date, $end_date, $teacher_id, $room_name) {

        $arr_time_table = \DB::select(
                            "SELECT time_table_id, day, start_time, end_time
                            FROM time_table WHERE room_name = '". $room_name ."'
                            AND time_table_id NOT IN
                            ( SELECT * FROM ( SELECT time_table_id FROM course_schedule
                            WHERE '" . $start_date . "' <= end_date AND '"
                            . $end_date ."' >= start_date
                            AND deleted_at IS NULL) AS subquery )
                            AND (day, start_time) NOT IN
                            ( SELECT * FROM ( SELECT t.day, t.start_time FROM time_table as t
                            JOIN course_schedule as cs
                            ON t.time_table_id = cs.time_table_id
                            WHERE cs.teacher_id = " . $teacher_id . "
                            AND '".  $start_date ."' <= end_date
                            AND '". $end_date . "' >= start_date) AS subquery2 )
                            ORDER BY day"
                        );

        return $arr_time_table;
    }
}
