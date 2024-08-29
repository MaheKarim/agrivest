<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use GlobalStatus;



    public function projects()
    {
        return $this->hasMany(Project::class);
    }

}
