<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use GlobalStatus;

    protected $casts = [
        'gallery' => 'array',
        'seo_content' => 'object',
    ];

    public function time()
    {
        return $this->belongsTo(Time::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class, 'project_id', 'id')->active();
    }

    public function scopeBeforeEndDate($query)
    {
        return $query->where('end_date', '>=', now());
    }

    public function scopeAvailable($query)
    {
        return $query->where('available_share', '>', 0);
    }

    public function scopeEnd($query)
    {
        return $query->where('status', Status::PROJECT_END);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', Status::PROJECT_FEATURED);
    }


    public function scopeLifetime($query)
    {
        return $query->where('return_type', Status::LIFETIME);
    }

    public function scopeRepeat($query)
    {
        return $query->where('return_type', Status::REPEAT);
    }

    public function statusBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';

            if ($this->status == Status::PROJECT_CONFIRMED) {
                $html = '<span class="badge badge--success">' . trans('Enabled') . '</span>';
            } elseif ($this->status == Status::PROJECT_END) {
                $html = '<span class="badge badge--primary">' . trans('Closed') . '</span>';
            } else {
                $html = '<span class="badge badge--danger">' . trans('Disabled') . '</span>';
            }

            return $html;
        });
    }

    public function typeBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';

            if ($this->return_type == Status::LIFETIME) {
                $html = '<span class="badge badge--info">' . trans('Lifetime') . '</span>';
            } elseif ($this->return_type == Status::REPEAT) {
                $html = '<span class="badge badge--primary">' . trans('Repeat') . '</span>';
            }

            return $html;
        });
    }
}
