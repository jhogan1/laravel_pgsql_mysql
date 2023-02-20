<?php

namespace App\Repositories\Eloquent;

use App\Models\ColorCategory;
use App\Repositories\ColorCategoryRepositoryInterface;

/**
 * ColorCategoryRepository_Class
 */
class ColorCategoryRepository extends BaseRepository implements ColorCategoryRepositoryInterface
{
    /**
     * ColorCategoryRepository_Constructor
     *
     * @param ColorCategory $model
     */
    public function __construct(ColorCategory $model)
    {
        parent::__construct($model);
    }
}
