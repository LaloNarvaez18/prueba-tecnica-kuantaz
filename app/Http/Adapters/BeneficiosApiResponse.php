<?php

namespace App\Http\Adapters;

use App\Exceptions\FailedApiResponseException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class BeneficiosApiResponse
{
    protected const BENEFICIOS_ENDPOINT = '/8f75c4b5-ad90-49bb-bc52-f1fc0b4aad02';
    protected const FILTROS_ENDPOINT = '/b0ddc735-cfc9-410e-9365-137e04e33fcf';
    protected const FICHAS_ENDPOINT = '/4654cafa-58d8-4846-9256-79841b29a687';

    public function getPoolResponses() : array
    {
        $responses = Http::pool(function ($pool) {
            $pool->as('beneficios')->get(env('BENEFICIOS_API_BASE_URL') . self::BENEFICIOS_ENDPOINT);
            $pool->as('filtros')->get(env('BENEFICIOS_API_BASE_URL') . self::FILTROS_ENDPOINT);
            $pool->as('fichas')->get(env('BENEFICIOS_API_BASE_URL') . self::FICHAS_ENDPOINT);
        });

        $this->handleErrorPoolResponses($responses);

        return $responses;
    }

    public function getBeneficiosResponse() : Response
    {
        $response = Http::beneficiosApi()->get(self::BENEFICIOS_ENDPOINT);
        if ($response->failed()) {
            $this->handleErrorResponse($response, 'No se pudieron obtener los beneficios.');
        }
        return $response;
    }

    public function getFiltrosResponse() : Response
    {
        $response = Http::beneficiosApi()->get(self::FILTROS_ENDPOINT);
        if ($response->failed()) {
            $this->handleErrorResponse($response, 'No se pudieron obtener los filtros.');
        }
        return $response;
    }

    public function getFichasResponse() : Response
    {
        $response = Http::beneficiosApi()->get(self::FICHAS_ENDPOINT);
        if ($response->failed()) {
            $this->handleErrorResponse($response, 'No se pudieron obtener las fichas.');
        }
        return $response;
    }

    private function handleErrorResponse(Response $response, string $message): void
    {
        throw new FailedApiResponseException($message, $response->status());
    }

    private function handleErrorPoolResponses(array $response): void
    {
        if(
            $response['beneficios']->failed() ||
            $response['filtros']->failed() ||
            $response['fichas']->failed()
        ) {
            throw new FailedApiResponseException('No se pudieron obtener los beneficios, filtros o fichas.', 500);
        }
    }
}
