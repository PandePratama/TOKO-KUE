<?php

// app/Models/Order.php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'pickup_date',
        'payment_proof',
        'payment_method'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pickupDate()
    {
        return $this->belongsTo(PickupDate::class, 'pickup_date', 'pickup_date');
    }

    public function getFormattedPickupDateAttribute()
    {
        return $this->pickup_date
            ? Carbon::parse($this->pickup_date)->format('d-m-Y')
            : null;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function statusHistories()
    {
        return $this->hasMany(OrderStatusHistory::class)->orderBy('created_at');
    }
}
