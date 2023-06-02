<?php

namespace Modules\Map\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $popup_text
 * @property float  $lat
 * @property float  $long
 */
class Marker extends Model
{

    use HasFactory;

    protected $fillable
        = [
            'popup_text',
            'lat',
            'long',
        ];

    public $table = 'map_marker';

}
