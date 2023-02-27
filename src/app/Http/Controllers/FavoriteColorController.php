<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Eloquent\FavoriteColorRepository;
use App\Repositories\Eloquent\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @param UserRepository $userRepository
     */
    public function __construct(
        protected FavoriteColorRepository $favoriteColorRepository,
        protected UserRepository $userRepository
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     *
     * @OA\Get(
     *     path="/api/favorite-colors",
     *     summary="Get all the favorite color records",
     *     tags={"FavoriteColorController"},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server Error"
     *     )
     * )
     */
    public function index(): Response
    {
        $favoriteColors = $this->favoriteColorRepository->all();

        return Response($favoriteColors);
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
     * @return Response
     *
     * @OA\Post(
     *     path="/api/favorite-colors",
     *     summary="Add a new favorite color record",
     *     tags={"FavoriteColorController"},
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="error"
     *     ),
     *     @OA\RequestBody(
     *         description="payload",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"user_id","color_id"},
     *                 @OA\Property(
     *                     property="user_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="color_id",
     *                     type="integer"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request): Response
    {
        $newFavoriteColor = $this->favoriteColorRepository->create($request->all());

        return Response($newFavoriteColor);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *     path="/api/favorite-colors/{id}",
     *     summary="Get a favorite color record by ID",
     *     tags={"FavoriteColorController"},
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="error"
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="favorite_colors.id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     )
     * )
     */
    public function show(int $id): Response
    {
        $favoriteColor = $this->favoriteColorRepository->find($id);

        if (empty($favoriteColor)) {
            return Response('Error', 500);
        }

        return Response($favoriteColor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return string
     *
     * @OA\Patch(
     *     path="/api/favorite-colors/{id}",
     *     summary="Update an existing favorite color record",
     *     tags={"FavoriteColorController"},
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="error"
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="favorite_colors.id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="payload",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"user_id","color_id"},
     *                 @OA\Property(
     *                     property="user_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="color_id",
     *                     type="integer"
     *                 )
     *             )
     *         )
     *     )
     * )
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
     *
     * @OA\Delete(
     *     path="/api/favorite-colors/{id}",
     *     summary="Delete a favorite color record",
     *     tags={"FavoriteColorController"},
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="error"
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="favorite_colors.id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     )
     * )
     */
    public function destroy(int $id): string
    {
        if ($this->favoriteColorRepository->destroy($id)) {
            return 'Favorite Color Record Deleted';
        } else {
            return 'Favorite Color Record Delete FAILED!';
        }
    }

    /**
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function getFavoriteColorByUserId(int $id): Response
    {
        /**
         * @var User $user
         */
        $user = $this->userRepository->find($id);

        $favoriteColor = $user->favoriteColor;

        $color = $favoriteColor->color;

        return Response($color);
    }
}
