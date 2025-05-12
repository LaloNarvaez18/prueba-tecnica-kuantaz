<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\BeneficiosApiService;
use App\Helpers\BeneficiosCollectionHelper;

class BeneficiosController extends Controller
{
    public function __construct(
        private BeneficiosApiService $apiService,
        private BeneficiosCollectionHelper $collectionHelper
    ){}

    public function get_beneficios_anuales(Request $request)
    {
        $data = $this->apiService->getBeneficiosMergeData();

        $beneficiosFiltered = $this->collectionHelper->filterByAmountRange($data);
        $beneficiosYear = $this->collectionHelper->groupByYear($beneficiosFiltered);
        $beneficiosMapped = $this->collectionHelper->mapGroupData($beneficiosYear);

        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => $beneficiosMapped
        ]);
    }
}
