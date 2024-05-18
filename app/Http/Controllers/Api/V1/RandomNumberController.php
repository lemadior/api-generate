<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CreateNumberResource;
use App\Http\Resources\Api\V1\RandomNumberResource;
use App\Services\Api\V1\CreateNumberService;
use App\Services\Api\V1\RandomNumberService;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;
use Exception;

/**
 * @OA\Info(
 *     title="RandomGen Api",
 *     version="1.0"
 * ),
 * @OA\PathItem(
 *     path="/api/v1/"
 * ),
 * @OA\Components(
 *     @OA\SecurityScheme(
 *         securityScheme="bearerAuth",
 *         type="http",
 *         scheme="bearer"
 *     )
 * ),
 * @OA\Server(
 *     url="http://localhost:5000/api/v1"
 * )
 */
class RandomNumberController extends Controller
{
    /**
     * @var RandomNumberService $getNumberService
     */
    protected RandomNumberService $getNumberService;

    /**
     * @var CreateNumberService $createService
     */
    protected CreateNumberService $createService;

    public function __construct()
    {
        $this->getNumberService = new RandomNumberService();
        $this->createService = new CreateNumberService();
    }

    /**
     * Generate random number and stored it to the database
     * Number has unique value
     *
     * @return JsonResponse|CreateNumberResource
     *
     * @OA\Post(
     *      path="/numbers",
     *      operationId="numberCreate",
     *      summary="Random Number Generation",
     *      description="Create the new random integer number",
     *      tags={"With Authentication"},
     *      security={{ "bearerAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(description="Data array",
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="id", type="integer", example=42, description="ID of the newly created student record"),
     *                  @OA\Property(property="number", type="integer", example=420, description="Value of the newly created number"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="Bad Request",
     *          @OA\JsonContent(
     *                  @OA\Property(property="error", type="string", example="Wrong request!")
     *          )
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Resource not found"
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Unprocessable Content",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="error", type="object",
     *                      @OA\Property(property="action", type="string", example="create_student", description="name of the action where error is occurred"),
     *                      @OA\Property(property="message", type="string", example="Fail due to some errors", description="Error message if incoming parameters is wrong")
     *              )
     *          )
     *      )
     *  )
     */
    public function generate(): JsonResponse | CreateNumberResource
    {
        try {
            $newRecord = $this->createService->createNewNumber();
        } catch (Exception $err) {
            return response()->json(
                [
                    'error' => [
                        'action' => 'create_number',
                        'message' => $err->getMessage()
                    ]
                ],
                422
            );
        }

        return new CreateNumberResource([
            'newRecord' => $newRecord
        ]);
    }


    /**
     * Get number stored in the database by it ID
     *
     * @param int $id
     *
     * @return JsonResponse|RandomNumberResource
     *
     * @OA\Get(
     *     path="/numbers/{id}",
     *     operationId="numberId",
     *     summary="Get number by it ID",
     *     description="Retrieve number",
     *     tags={"Without Authentication"},
     *     @OA\Parameter(
     *         description="Number ID",
     *         in="path",
     *         name="id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="1", value="2", summary="Random number with ID=2"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(description="Data array",
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example="2", description="ID of the number"),
     *                     @OA\Property(property="number", type="integer", example="345", description="Number value"),
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad Request",
     *         @OA\JsonContent(
     *                 @OA\Property(property="error", type="string", example="Wrong request!")
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Resource not found"
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Unprocessable Content",
     *         @OA\JsonContent(type="object",
     *             @OA\Property(property="error", type="object",
     *                     @OA\Property(property="action", type="string", example="get_number", description="name of the action where error is occurred"),
     *                     @OA\Property(property="message", type="string", example="Fail due to some errors", description="Error message if incoming parameters is wrong")
     *             )
     *         )
     *     )
     * )
     */
    public function retrieve(int $id): JsonResponse | RandomNumberResource
    {
        try {
            $foundedRecord = $this->getNumberService->getRecordById($id);
        } catch (Exception $err) {
            return response()->json(
                [
                    'error' => [
                        'action' => 'get_number',
                        'message' => $err->getMessage()
                    ]
                ],
                422
            );
        }

        return new RandomNumberResource([
            'foundedRecord' => $foundedRecord
        ]);
    }
}
