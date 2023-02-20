<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\ColorCategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * ColorCategoryController_Class
 */
class ColorCategoryController extends Controller
{
    /**
     * ColorCategoryController_Constructor
     *
     * @param ColorCategoryRepository $colorCategoryRepository
     */
    public function __construct(protected ColorCategoryRepository $colorCategoryRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->colorCategoryRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Model
     */
    public function store(Request $request): Model
    {
        return $this->colorCategoryRepository->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Model|null
     */
    public function show(int $id): ?Model
    {
        return $this->colorCategoryRepository->find($id);
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

        if ($this->colorCategoryRepository->update($id, $params)) {
            return 'Color Category Updated';
        } else {
            return 'Color Category Update FAILED!';
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
        if ($this->colorCategoryRepository->destroy($id)) {
            return 'Color Category Deleted';
        } else {
            return 'Color Category Deletion FAILED!';
        }
    }
}
