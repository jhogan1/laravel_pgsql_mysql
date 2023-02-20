<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\ColorRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * ColorController_Class
 */
class ColorController extends Controller
{
    /**
     * ColorController_Constructor
     *
     * @param ColorRepository $colorRepository
     */
    public function __construct(protected ColorRepository $colorRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->colorRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Model
     */
    public function store(Request $request): Model
    {
        return $this->colorRepository->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function show(int $id): Response
    {
        throw new Exception('not implemented');
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

        if ($this->colorRepository->update($id, $params)) {
            return 'Color Record Updated';
        } else {
            return 'Color Record Update FAILED!';
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
        if ($this->colorRepository->destroy($id)) {
            return 'Color Deleted';
        } else {
            return 'Color Deletion FAILED!';
        }
    }
}
