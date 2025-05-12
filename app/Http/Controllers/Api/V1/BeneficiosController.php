<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\BeneficiosApiService;
use App\Helpers\BeneficiosCollectionHelper;

/**
    @OA\Info(
        title="API Beneficios Anuales",
        version="1.0",
        description="Listado de beneficios anuales obtenidos por un usuario"
    )

    @OA\Server(url="http://localhost:8000/")
*/
class BeneficiosController extends Controller
{
    public function __construct(
        private BeneficiosApiService $apiService,
        private BeneficiosCollectionHelper $collectionHelper
    ){}


    /**
        Obtener listado de beneficios agrupados por año
        @OA\Get(
            path="/api/v1/beneficios/anuales",
            tags={"Beneficios"},
            description="Retorna una lista de beneficios agrupados por año, el monto total recibido y número de beneficios obtenidos",
            @OA\Response(
                response=200,
                description="Lista de beneficios agrupados por año",
                @OA\JsonContent(
                    type="object",
                    @OA\Property(property="code", type="integer", example=200),
                    @OA\Property(property="success", type="boolean", example=true),
                    @OA\Property(
                        property="data",
                        type="array",
                        @OA\Items(
                            type="object",
                            @OA\Property(property="year", type="integer", example=2024),
                            @OA\Property(property="monto_total", type="integer"),
                            @OA\Property(property="numero_beneficios", type="integer"),
                            @OA\Property(
                                property="beneficios",
                                type="array",
                                @OA\Items(
                                    type="object",
                                    @OA\Property(property="id_programa", type="integer"),
                                    @OA\Property(property="monto", type="integer"),
                                    @OA\Property(property="fecha_recepcion", type="string", format="date"),
                                    @OA\Property(property="fecha", type="string", format="date"),
                                    @OA\Property(property="ano", type="integer", example=2024),
                                    @OA\Property(property="view", type="boolean"),
                                    @OA\Property(
                                        property="ficha",
                                        type="object",
                                        @OA\Property(property="id", type="integer"),
                                        @OA\Property(property="nombre", type="string"),
                                        @OA\Property(property="id_programa", type="integer"),
                                        @OA\Property(property="url", type="string"),
                                        @OA\Property(property="categoria", type="string"),
                                        @OA\Property(property="descripcion", type="string")
                                    )
                                )
                            )
                        )
                    )
                )
            )
        )
    */
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
