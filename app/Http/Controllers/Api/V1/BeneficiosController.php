<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\BeneficiosApiService;

class BeneficiosController extends Controller
{
    public function __construct(
        private BeneficiosApiService $apiService
    ){}

    public function get_beneficios_anuales(Request $request)
    {
        $beneficios = $this->apiService->getBeneficiosMergeData();

        // Se ultilizan macros para mapear datos según el formato requerido
        $data = $beneficios
                    ->filterByAmountRange()
                    ->groupByYear()
                    ->mapRequiredData();

        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => $data
        ]);
    }
}
