<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'payment_id',
        'address',
        'phone',
        'email',
        'full_name',
        'payment_method',
        'currency',
        'order_merchant_id',
        'invoice_reference_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}


