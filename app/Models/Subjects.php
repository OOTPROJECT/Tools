<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    // table name
    protected $table = 'subjects';

    function getSubject() {
        $all_subject = subjects::orderBy('subject_id')->get();

        return $all_subject;
    }
}
