<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\FavoriteColorRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

/**
 * UserController_Class
 */
class UserController extends Controller
{
    /**
     * @param FavoriteColorRepository $favoriteColorRepository
     */
    public function __construct(
        protected FavoriteColorRepository $favoriteColorRepository
    )
    {
    }

    /**
     * @param int $colorId
     * @return Response
     */
    public function getUsersByFavoriteColorsColorId(int $colorId): Response
    {
        $favoriteColors = $this->favoriteColorRepository->getByColorId($colorId);

        $users = new Collection();
        foreach ($favoriteColors as $favoriteColor) {
            $users->add($favoriteColor->user);
        }

        return Response($users);
    }
}
