<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invest extends Model
{
    public function deposit()
    {
        return $this->hasOne(Deposit::class, 'invest_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
