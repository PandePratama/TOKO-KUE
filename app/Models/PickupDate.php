<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupDate extends Model
{
    use HasFactory;

    protected $table = 'pickup_dates';

    protected $fillable = [
        'pickup_date',
        'note',
        'is_available',
    ];

    protected $casts = [
        'pickup_date' => 'date',
        'is_available' => 'boolean',
    ];

    /**
     * Relasi ke pesanan (orders)
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'pickup_date', 'pickup_date');
    }
}
