<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * class FavoriteController
 */
class FavoriteController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws Exception
     */
    public function create(): Response
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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function edit(int $id): Response
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
