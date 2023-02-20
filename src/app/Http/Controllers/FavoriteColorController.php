<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\FavoriteColorRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return Response
     * @throws Exception
     */
    public function index(): Response
    {
        throw new Exception('not implemented');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function store(Request $request): Response
    {
        throw new Exception('not implemented');
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
     * @return Response
     * @throws Exception
     */
    public function update(Request $request, int $id): Response
    {
        throw new Exception('not implemented');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function destroy(int $id): Response
    {
        throw new Exception('not implemented');
    }
}
