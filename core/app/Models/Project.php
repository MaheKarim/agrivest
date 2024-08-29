<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use GlobalStatus;

    public function time()
    {
        return $this->belongsTo(Time::class);
    }
}
