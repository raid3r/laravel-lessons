<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

/**
 * @property int         $id
 * @property string      $text
 * @property int         poll_variant_id
 * @property PollVariant $variant
 */
class PollAnswer extends Model
{

    use HasFactory;

    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = 'poll_answers';

    public $fillable
        = [
            'poll_variant_id',
        ];

    //TOD

    public function getVariant(): BelongsTo
    {
        return $this->belongsTo(PollVariant::class);
    }


}
