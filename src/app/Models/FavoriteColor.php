<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * FavoriteColor_Class
 */
class FavoriteColor extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_name',
        'color_id'
    ];

    /**
     * @return HasOne
     */
    public function color(): HasOne
    {
        return $this->hasOne(Color::class, 'color_id');
    }
}
