<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\OrderItem
 *
 * @property mixed $order
 * @property mixed $product
 * @property int product_id
 * @property float price
 * @property int qty
 * @property float sub_total
 * @property int $id
 * @property int $order_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|OrderItem newModelQuery()
 * @method static Builder|OrderItem newQuery()
 * @method static Builder|OrderItem query()
 * @method static Builder|OrderItem whereCreatedAt($value)
 * @method static Builder|OrderItem whereId($value)
 * @method static Builder|OrderItem whereOrderId($value)
 * @method static Builder|OrderItem wherePrice($value)
 * @method static Builder|OrderItem whereProductId($value)
 * @method static Builder|OrderItem whereQty($value)
 * @method static Builder|OrderItem whereSubTotal($value)
 * @method static Builder|OrderItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderItem extends Model
{
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('product', function (Builder $builder) {
            $builder->whereHas('product');
        });
    }

    public function getTotalAttribute()
    {
        return $this->qty * $this->price;
    }
}
