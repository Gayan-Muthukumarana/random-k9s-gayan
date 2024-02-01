<?php

namespace App\Http\Controllers;

use App\Enums\StatusNamesEnum;
use App\Http\Requests\GetUserRelatedFactRequest;
use App\Http\Resources\UserRelatedFactResource;
use App\Services\GetUserRelatedFactService;
use Illuminate\Http\Response;

/**
 * @OA\Tag(
 *     name="Random Fact",
 * )
 *
 */
class FactController extends Controller
{
    /**
     * Get a random fact based on the user's preference.
     *
     * @param GetUserRelatedFactRequest $request
     * @param GetUserRelatedFactService $getUserRelatedFactService
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *   path="/api/random-fact",
     *   operationId="getRandomFact",
     *   tags={"Random Fact"},
     *   summary="Get a random fact according to the user type",
     *   description="Returns a fact according to the user type as numberphile or non-numberphile",
     *   @OA\Parameter(
     *      name="user_type",
     *      in="query",
     *      description="User type as numberphile or non-numberphile",
     *      required=false,
     *      @OA\Schema(type="string", example="numberphile")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property (property="status", type="boolean", description="Status", example="Success"),
     *       @OA\Property (property="message", type="string", description="Successfully retrieved datax", example="Successfully retrieved data"),
     *       @OA\Property (property="data", type="string", example="A dog’s heart beats up to 120 times per minute, or 50 faster than the average human heartbeat of 80 times per minute"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Not found",
     *     @OA\JsonContent(
     *       @OA\Property (property="status", type="boolean", description="Status", example="Error"),
     *       @OA\Property (property="message", type="string", description="No matching record found!", example="No matching record found!"),
     *       @OA\Property (property="data", type="string", description=NULL, example=NULL)
     *     )
     *   ),
     * )
     *
     */
    public function getRandomFact(GetUserRelatedFactRequest $request, GetUserRelatedFactService $getUserRelatedFactService)
    {
        $userType = $request->has('user_type') ? $request->input('user_type') : '';

        $fact = $getUserRelatedFactService->getRandomFactByUserType($userType);

        $result = new UserRelatedFactResource($fact);

        if (isset($result->description)) {
            $status = StatusNamesEnum::SUCCESS->value;
            $message = 'Successfully retrieved data';
            $data = $result->description;
            $statusCode = Response::HTTP_OK;
        } else {
            $status = StatusNamesEnum::ERROR->value;
            $message = 'No matching record found!';
            $data = null;
            $statusCode = Response::HTTP_NOT_FOUND;
        }

        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }
}
