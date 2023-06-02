<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

/**
 * @property int         $id
 * @property string      $title
 * @property float       $price
 * @property integer     $quantity
 * @property int         $category_id
 * @property string|null $image
 * @property Category    $category
 */
class Product extends Model
{
    use HasFactory;

    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = 'products';

    public $fillable
        = [
            'title',
            'price',
            'quantity',
            'category_id'
        ];

    public function getCategory(): HasOne
    {
        return $this->hasOne(Category::class);
    }

    public function getImageUrl(): ?string
    {
        if (empty($this->image)) {
            return null;
        }

        return Storage::url($this->image);
    }
}
