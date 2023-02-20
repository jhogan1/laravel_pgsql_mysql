<?php

namespace App\Repositories\Eloquent;

use App\Models\Color;
use App\Repositories\ColorRepositoryInterface;

/**
 * ColorRepository_Class
 */
class ColorRepository extends BaseRepository implements ColorRepositoryInterface
{
    /**
     * ColorRepository_Constructor
     *
     * @param Color $model
     */
    public function __construct(Color $model)
    {
        parent::__construct($model);
    }
}
