<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * ColorCategory_Class a model for the color_category table
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
     * @return hasMany
     */
    public function colorCategories(): HasMany
    {
        return $this->hasMany(Color::class, 'category_id');
    }
}
