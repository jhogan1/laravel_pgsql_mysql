<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\FavoriteColorRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewAlias;

/**
 * FavoriteColorController_Class
 */
class FavoriteColorController extends Controller
{
    /**
     * FavoriteColorController_Constructor
     *
     * @param FavoriteColorRepository $favoriteColorRepository
     */
    public function __construct(protected FavoriteColorRepository $favoriteColorRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->favoriteColorRepository->all();
    }

    /**
     * @return ViewAlias
     */
    public function home(): ViewAlias
    {
        return View::make('favorite_color.pages.home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Model
     */
    public function store(Request $request): Model
    {
        return $this->favoriteColorRepository->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Model|null
     */
    public function show(int $id): ?Model
    {
        return $this->favoriteColorRepository->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return string
     */
    public function update(Request $request, int $id): string
    {
        $params = json_decode($request->getContent(), true);

        if ($this->favoriteColorRepository->update($id, $params)) {
            return 'Favorite Color Record Updated';
        } else {
            return 'Favorite Color Record Update FAILED!';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return string
     */
    public function destroy(int $id): string
    {
        if ($this->favoriteColorRepository->destroy($id)) {
            return 'Favorite Color Record Deleted';
        } else {
            return 'Favorite Color Record Delete FAILED!';
        }
    }
}
