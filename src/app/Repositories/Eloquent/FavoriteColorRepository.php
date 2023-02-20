<?php

namespace App\Repositories\Eloquent;

use App\Models\FavoriteColor;
use App\Repositories\FavoriteColorRepositoryInterface;

/**
 * FavoriteColorRepository_Class
 */
class FavoriteColorRepository extends BaseRepository implements FavoriteColorRepositoryInterface
{
    /**
     * @param FavoriteColor $model
     */
    public function __construct(FavoriteColor $model)
    {
        parent::__construct($model);
    }
}
