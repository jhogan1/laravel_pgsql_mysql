<?php

namespace App\Repositories\Eloquent;

use App\Models\FavoriteColor;
use App\Repositories\FavoriteColorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * FavoriteColorRepository_Class
 */
class FavoriteColorRepository extends BaseRepository implements FavoriteColorRepositoryInterface
{
    /**
     * FavoriteColorRepository_Constructor
     *
     * @param FavoriteColor $model
     */
    public function __construct(FavoriteColor $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $colorId
     * @return Collection
     */
    public function getByColorId(int $colorId): Collection
    {
       return $this->model::where('color_id', '=', $colorId)->get();
    }
}
