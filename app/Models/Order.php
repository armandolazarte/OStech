<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\ShippingType;
use App\Traits\UniqueGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Order extends Model
{
    use HasFactory, UniqueGenerator;

    protected $fillable = [
        'user_id',
        'client',
        'shipping_company_id',
        'shipping_type',
        'shipping_cost',
        'payment_method',
        'coupon_id',
        'coupon_code',
        'discount',
        'sub_total',
        'total',
        'status',
        'is_online',
    ];

    protected $casts = [
        'client' => 'array',
        'status' => OrderStatus::class,
        'payment_method' => PaymentMethod::class,
        'shipping_type' => ShippingType::class,
        'is_online' => 'boolean',
        'created_at' => 'datetime:d-m-Y H:i',
        'updated_at' => 'datetime:d-m-Y H:i'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(fn (Order $order) => $order->ref = $order->generateRef());
    }

    public function scopeAdmin(Builder $query)
    {
        $query->select('id', 'ref', 'client', 'shipping_type', 'shipping_cost', 'payment_method', 'coupon_code', 'discount', 'sub_total', 'total', 'status', 'is_online', 'created_at');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot(['qte', 'prices', 'product']);
    }

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class, 'coupon_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
