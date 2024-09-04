<?php

namespace App\Models;

use App\Constants\Status;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function scopeTotalInvest($query)
    {
        return $query->sum('total_price');
    }

    public function scopeTotalEarn($query)
    {
        return $query->sum('total_earning');
    }

    public function statusBadge()
    : Attribute
    {
        return new Attribute(
            get: fn () => $this->badgeData(),
        );
    }

    public function badgeData()
    {
        $html = '';
        if ($this->status == Status::INVEST_PENDING) {
            $html = '<span class="badge badge--status badge--warning">' . trans('Pending') . '</span>';
        } elseif ($this->status == Status::INVEST_COMPLETED) {
            $html = '<span class="badge badge--status badge--success">' . trans('Completed') . '</span>';
        } elseif ($this->status == Status::INVEST_ACCEPT) {
            $html = '<span class="badge badge--status badge--primary">' . trans('Accepted') . '</span>';
        } elseif ($this->status == Status::INVEST_RUNNING) {
            $html = '<span class="badge badge--status badge--info">' . trans('Running') . '</span>';
        } else {
            $html = '<span class="badge badge--status badge--danger">' . trans('Canceled') . '</span>';
        }
        return $html;
    }
}
