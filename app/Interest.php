<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
