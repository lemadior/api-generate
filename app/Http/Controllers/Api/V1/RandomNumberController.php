<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CreateNumberResource;
use App\Http\Resources\Api\V1\RandomNumberResource;
use App\Services\Api\V1\CreateNumberService;
use App\Services\Api\V1\RandomNumberService;
use Illuminate\Http\JsonResponse;
use Exception;

/**
 *
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
