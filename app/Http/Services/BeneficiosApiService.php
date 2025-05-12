<?php

namespace App\Http\Services;

use Illuminate\Support\Collection;
use App\Http\Adapters\BeneficiosApiResponse;
use App\Http\Adapters\BeneficiosApiResponseFormatter;
class BeneficiosApiService
{
    public function __construct(
        protected BeneficiosApiResponse $responseAdapter,
        protected BeneficiosApiResponseFormatter $responseFormatter
    ){}


    /**
     * Obtener los beneficios del usuario, filtros y fichas en una sola petición
     *
     * @return Collection
     */
    public function getBeneficiosMergeData() : Collection
    {
        $responses = $this->responseAdapter->getPoolResponses();

        $beneficios = $this->responseFormatter->formatResponseData($responses['beneficios']);
        $filtros = $this->responseFormatter->formatResponseData($responses['filtros']);
        $fichas = $this->responseFormatter->formatResponseData($responses['fichas']);

        return $this->responseFormatter->mergeResponseData($beneficios, $filtros, $fichas);
    }

    /**
     * Obtener los beneficios del usuario
     *
     * @return Collection
     */
    public function getBeneficiosData() : Collection
    {
        $response = $this->responseAdapter->getBeneficiosResponse();
        return $this->responseFormatter->formatResponseData($response);
    }

    /**
     * Obtener los filtros correspondientes a los beneficios
     *
     * @return Collection
     */
    public function getFiltrosData() : Collection
    {
        $response = $this->responseAdapter->getFiltrosResponse();
        return $this->responseFormatter->formatResponseData($response);
    }

    /**
     * Obtener las fichas de los beneficios
     *
     * @return Collection
     */
    public function getFichasResponse() : Collection
    {
        $response = $this->responseAdapter->getFichasResponse();
        return $this->responseFormatter->formatResponseData($response);
    }
}
