<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
use App\Http\Handlers\BeneficiosApiHandler;

class BeneficiosApiService
{
    public function __construct(
        protected BeneficiosApiHandler $handler
    )
    {}

    public function getBeneficios()
    {
        $response = $this->handler->beneficios();

        if (!$response->ok()) {
            throw new \Exception("Error al obtener los beneficios");
        }

        return $response->collect();
    }

    public function getFiltros()
    {
        $response = $this->handler->filtros();

        if (!$response->ok()) {
            throw new \Exception("Error al obtener el filtros");
        }

        return $response->collect();
    }

    public function getFichas()
    {
        $response = $this->handler->fichas();

        if (!$response->ok()) {
            throw new \Exception("Error al obtener el fichas");
        }

        return $response->collect();
    }
}
