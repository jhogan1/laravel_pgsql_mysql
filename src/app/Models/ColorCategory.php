<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * ColorCategory_Class a model for the color_category table
 *
 * @property Collection $colors
 */
class ColorCategory extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return HasMany
     */
    public function colors(): HasMany
    {
        return $this->hasMany(Color::class, 'category_id');
    }
}
