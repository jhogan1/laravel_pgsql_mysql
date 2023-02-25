<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Color_Class a model for the color table
 */
class Color extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'color',
        'category_id',
        'hex'
    ];

    /**
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(ColorCategory::class);
    }

    /**
     * @return HasOne
     */
    public function favoriteColor(): HasOne
    {
        return $this->hasOne(FavoriteColor::class);
    }
}
