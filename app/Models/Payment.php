<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $description
 * @property int    $order_id
 * @property string $card_mask
 * @property string $currency
 * @property float  $amount
 * @property string $result
 * @property string $liqpay_order_id
 * @property string $status
 * @property string $payment_id
 * @property string $paytype
 */
class Payment extends Model
{

    use HasFactory;

    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = 'payments';

    public $fillable
        = [
            'description',
            'order_id',
            'card_mask',
            'currency',
            'amount',
            'result',
            'liqpay_order_id',
            'status',
            'payment_id',
            'paytype',
        ];
}
