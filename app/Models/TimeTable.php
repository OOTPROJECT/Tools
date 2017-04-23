<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    // Table name
    protected $table = 'time_table';

    function getTimeTable() {
        $all_time_table = TimeTable::select('day', 'start_time', 'end_time')
                            ->distinct()->orderBy('day', 'start_time', 'end_time')->get();

        return $all_time_table;
    }
}
