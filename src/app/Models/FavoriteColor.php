<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * FavoriteColor_Class
 *
 * @property Color $color
 * @property User $user
 */
class FavoriteColor extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'color_id'
    ];

    /**
     * @return BelongsTo
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
