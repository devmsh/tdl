<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Interest extends Model
{
    use Notifiable;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
