<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'provider',
        'status',
        'prepay_link',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
