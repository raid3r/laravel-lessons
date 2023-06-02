<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

/**
 * @property int          $id
 * @property string       $text
 * @property int          $poll_id
 * @property PollAnswer[] $answers
 */
class PollVariant extends Model
{

    use HasFactory;

    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = 'poll_variants';

    public $fillable
        = [
            'text',
            'poll_id',
        ];

    //TOD

    public function getPoll(): BelongsTo
    {
        return $this->belongsTo(Poll::class);
    }

    public function getAnswers(): HasMany
    {
        return $this->hasMany(PollAnswer::class);
    }
}
