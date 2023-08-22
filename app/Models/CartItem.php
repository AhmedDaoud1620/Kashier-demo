<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $table = 'cart_items';

    protected $fillable = [
        'shopping_session_id',
        'product_id',
        'quantity',
    ];

    public function shoppingSession()
    {
        return $this->belongsTo(ShoppingSession::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
