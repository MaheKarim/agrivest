<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invest extends Model
{
    public function deposit()
    {
        return $this->hasOne(Deposit::class, 'order_id');
    }

}
