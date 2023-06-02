<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * @property int           $id
 * @property string        $title
 * @property string        $description
 * @property-read  Collection|PollVariant[] $variants
 * @property-read  Collection|PollAnswer[]  $answers
 */
class Poll extends Model
{

    use HasFactory;

    protected static function booted()
    {
        static::deleting(function (Poll $poll) {
            if ($poll->answers) {
                foreach ($poll->answers as $answer) {
                    $answer->delete();
                }
            }
            if ($poll->variants) {
                foreach ($poll->variants as $variant) {
                    $variant->delete();
                }
            }

        });
    }

    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = 'polls';

    public $fillable
        = [
            'title',
            'description',
        ];

    //TOD

    public function getVariants(): HasMany
    {
        return $this->hasMany(PollVariant::class, 'poll_id', 'id');
    }

    public function getAnswers(): HasManyThrough
    {
        return $this->hasManyThrough(PollAnswer::class, PollVariant::class, 'poll_id', 'poll_variant_id', 'id', 'id');
    }

}
