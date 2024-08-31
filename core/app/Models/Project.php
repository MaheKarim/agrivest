<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use GlobalStatus;

    protected $casts = [
        'gallery'  => 'array'
    ];

    public function time()
    {
        return $this->belongsTo(Time::class);
    }
}
