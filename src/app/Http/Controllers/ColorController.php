<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\ColorCategoryRepository;
use App\Repositories\Eloquent\ColorRepository;
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
     * @param ColorCategoryRepository $colorCategoryRepository
     */
    public function __construct(
        protected ColorRepository $colorRepository,
        protected ColorCategoryRepository $colorCategoryRepository
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     *
     * @OA\Get(
     *     path="/api/colors",
     *     summary="Get all the colors",
     *     tags={"ColorController"},
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
        $colors = $this->colorRepository->all();

        return Response($colors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *     path="/api/colors",
     *     summary="Add a new color",
     *     tags={"ColorController"},
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
     *                 @OA\Property(
     *                     property="color",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="hex",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="category_id",
     *                     type="integer"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request): Response
    {
        $newColor = $this->colorRepository->create($request->all());

        return Response($newColor);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *     path="/api/colors/{id}",
     *     summary="Get a color by ID",
     *     tags={"ColorController"},
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
     *         description="colors.id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     )
     * )
     */
    public function show(int $id): Response
    {
        $color = $this->colorRepository->find($id);

        if (empty($color)) {
            return Response('Error', 500);
        }

        return Response($this->colorRepository->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return string
     *
     * @OA\Patch(
     *     path="/api/colors/{id}",
     *     summary="Update an existing color",
     *     tags={"ColorController"},
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
     *         description="colors.id",
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
     *                 description="properties are optional",
     *                 required={},
     *                 @OA\Property(
     *                     property="color",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="hex",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="category_id",
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
     *
     * @OA\Delete(
     *     path="/api/colors/{id}",
     *     summary="Delete a color",
     *     tags={"ColorController"},
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
     *         description="colors.id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     )
     * )
     */
    public function destroy(int $id): string
    {
        if ($this->colorRepository->destroy($id)) {
            return 'Color Deleted';
        } else {
            return 'Color Deletion FAILED!';
        }
    }

    /**
     * @param int $id
     * @return Response
     */
    public function getColorsByCategoryId(int $id): Response
    {
        $category = $this->colorCategoryRepository->find($id);

        $colors = null;
        if (!empty($category->colors)) {
            $colors = $category->colors;
        }

        return Response($colors);
    }
}
