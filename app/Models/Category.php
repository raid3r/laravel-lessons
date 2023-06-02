<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

/**
 * @property int         $id
 * @property string      $title
 * @property string|null $image
 * @property Product[]   $products
 */
class Category extends Model
{

    use HasFactory;

    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = 'categories';

    public $fillable
        = [
            'title',
        ];

    public function getProducts(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getImageUrl(): ?string
    {
        if (empty($this->image)) {
            return null;
        }

        return Storage::url($this->image);
    }
}
