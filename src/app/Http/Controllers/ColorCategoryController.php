<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\ColorCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return Response
     *
     * @OA\Get(
     *     path="/api/color-categories",
     *     summary="Get all the color categories",
     *     tags={"ColorCategoryController"},
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
        $colorCategories = $this->colorCategoryRepository->all();

        return Response($colorCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *     path="/api/color-categories",
     *     summary="Add a new color category",
     *     tags={"ColorCategoryController"},
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
     *                 required={"name"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request): Response
    {
        $newColorCategory = $this->colorCategoryRepository->create($request->all());

        return Response($newColorCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *     path="/api/color-categories/{id}",
     *     summary="Get a color category by ID",
     *     tags={"ColorCategoryController"},
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
     *         description="color_catetories.id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     )
     * )
     */
    public function show(int $id): Response
    {
        $colorCategory = $this->colorCategoryRepository->find($id);

        if (empty($colorCategory)) {
            return Response('Error', 500);
        }

        return Response($colorCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return string
     *
     * @OA\Patch(
     *     path="/api/color-categories/{id}",
     *     summary="Update and existing color category",
     *     tags={"ColorCategoryController"},
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
     *         description="color_categories.id",
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
     *                 required={"name"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     )
     * )
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
     *
     * @OA\Delete(
     *     path="/api/color-categories/{id}",
     *     summary="Delete a color category",
     *     tags={"ColorCategoryController"},
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
     *         description="color_categories.id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     )
     * )
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
