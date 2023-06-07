<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int    $id
 * @property string $title
 * @property string $description
 * @property float  $target_amount
 *
 */
class Donate extends Model
{

    use HasFactory;

    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = 'donates';

    public $fillable
        = [
            'title',
            'description',
            'target_amount',
        ];

    /**
     * @return HasMany|Payment[]
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'donate_id', 'id');
    }

    /**
     * @return HasMany|DonatePayment[]
     */
    public function donate_payments(): HasMany
    {
        return $this->hasMany(DonatePayment::class, 'donate_id', 'id');
    }

    public function donePercent(): int
    {
        $collected = $this->donate_payments()
                          ->where('status', '=', DonatePayment::STATUS_SUCCESS)
                          ->sum('amount');
        if ($this->target_amount == 0) {
            return 100;
        }

        return intval($collected / $this->target_amount * 100);
    }
}
