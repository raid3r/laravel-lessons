<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int    $id
 * @property int    $donate_id
 * @property string $status
 * @property float  $amount
 * @property string $uid
 *
 */
class DonatePayment extends Model
{

    const STATUS_PENDING = 'pending';

    const STATUS_SUCCESS = 'success';

    const STATUS_CANCELED = 'canceled';

    use HasFactory;

    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = 'donate_payments';

    public $fillable
        = [
            'donate_id',
            'amount',
            'status',
        ];

    /**
     * @return BelongsTo
     */
    public function donate(): BelongsTo
    {
        return $this->belongsTo(Donate::class, 'donate_id', 'id');
    }
}
