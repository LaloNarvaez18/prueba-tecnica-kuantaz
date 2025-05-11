<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\BeneficiosApiService;

class BeneficiosController extends Controller
{
    public function __construct(
        private BeneficiosApiService $apiService
    ){

    }

    public function index()
    {
        return $this->apiService->getBeneficios();
    }

    public function get_beneficios_by_year(Request $request)
    {
        $beneficiosData = $this->beneficioRepository->getBeneficios();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
