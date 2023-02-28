<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

/**
 * Color_Class
 *
 * @property ColorCategory $category
 * @property Collection favoriteColor
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
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ColorCategory::class);
    }

    /**
     * @return HasMany
     */
    public function favoriteColor(): HasMany
    {
        return $this->hasMany(FavoriteColor::class);
    }
}
