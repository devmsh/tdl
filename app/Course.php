<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function haveEnoughInterests($real_candidate_count)
    {
        return $real_candidate_count >= $this->min_candidates;
    }
}
