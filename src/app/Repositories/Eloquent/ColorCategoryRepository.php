<?php

namespace App\Repositories\Eloquent;

use App\Models\ColorCategory;
use App\Repositories\ColorCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * ColorCategoryRepository_Class
 */
class ColorCategoryRepository extends BaseRepository implements ColorCategoryRepositoryInterface
{
    /**
     * @param ColorCategory $model
     */
    public function __construct(ColorCategory $model)
    {
        parent::__construct($model);
    }
}
