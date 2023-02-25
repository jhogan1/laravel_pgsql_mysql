<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ColorCategory::class);
    }

    /**
     * @return BelongsTo
     */
    public function favoriteColor(): BelongsTo
    {
        return $this->belongsTo(FavoriteColor::class);
    }
}
