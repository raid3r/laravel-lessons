<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int    $id
 * @property string $title
 * @property string $description
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
}
