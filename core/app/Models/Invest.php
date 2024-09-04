<?php

namespace App\Models;

use App\Constants\Status;
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

    public function scopeCompleted($query)
    {
        return $query->where('status', Status::INVEST_COMPLETED);
    }

    // In my Invest Model I Have total_price column , Now I want to make scope that will sum single user total_price
    public function scopeTotalInvest($query)
    {
        return $query->sum('total_price');
    }

    public function scopeTotalEarn($query)
    {
        return $query->sum('total_earning');
    }
}
