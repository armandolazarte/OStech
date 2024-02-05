<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShippingCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function shippingPricings(): HasMany
    {
        return $this->hasMany(ShippingPricing::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

}
