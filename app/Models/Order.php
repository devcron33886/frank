<?php

namespace App\Models;

use App\Notifications\OrderStatusNotification;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Notification;

/**
 * App\Order
 *
 * @property Carbon $created_at
 * @property int $id
 * @property Carbon $updated_at
 * @property mixed $order_items
 * @property mixed $user
 * @property array|null|string clientPhone
 * @property array|null|string shipping_address
 * @property string status
 * @property array|null|string clientName
 * @property float shipping_amount
 * @property array|null|string email
 * @property string notes
 * @property mixed order_no
 * @property int|null $user_id
 * @property-read Collection|OrderItem[] $orderItems
 * @property-read int|null $order_items_count
 * @property mixed payment_type
 *
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereClientName($value)
 * @method static Builder|Order whereClientPhone($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereEmail($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereNotes($value)
 * @method static Builder|Order whereOrderNo($value)
 * @method static Builder|Order whereShippingAddress($value)
 * @method static Builder|Order whereShippingAmount($value)
 * @method static Builder|Order whereStatus($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @method static Builder|Order whereUserId($value)
 *
 * @mixin Eloquent
 */
class Order extends Model
{
    public const STATUS_SELECT = [
        'Pending' => 'Pending',
        'Processing' => 'Processing',
        'On Way' => 'On Way',
        'Delivered' => 'Delivered',
        'Cancelled' => 'Cancelled',
        'Paid' => 'Paid',
    ];

    const PENDING = 'Pending';

    const PROCESSING = 'Processing';

    const ON_WAY = 'On Way';

    const DELIVERED = 'Delivered';

    const CANCELLED = 'Cancelled';

    const PAID = 'Paid';

    protected $appends = ['amount_to_pay'];

    protected $guarded = [];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function updated_by(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalAmountToPay(): float
    {
        return $this->orderItems->sum('sub_total') + $this->shipping_amount;
    }

    public function getAmountToPayAttribute(): float
    {
        return $this->getTotalAmountToPay();
    }

    public static function getStatuses(): array
    {
        return [self::PENDING, self::PROCESSING, self::ON_WAY, self::DELIVERED, self::PAID, self::CANCELLED];
    }

    public function setOrderNo(string $prefix = 'ORD', $pad_string = '0', int $len = 8)
    {
        $orderNo = $prefix.str_pad($this->id, $len, $pad_string, STR_PAD_LEFT);
        $this->order_no = $orderNo;
        $this->update();
    }

    public static function booting()
    {
        self::updated(function (Order $order) {
            if ($order->isDirty('status') && in_array($order->status, ['Pending', 'Processing', 'On Way', 'Delivered', 'Cancelled', 'Paid'])) {
                Notification::route('mail', $order->email)->notify(new OrderStatusNotification($order->status));
            }
        });
    }
}
