<?php

namespace App\Http\Adapters;

use Illuminate\Support\Collection;
use Illuminate\Http\Client\Response;

class BeneficiosApiResponseFormatter
{
    /**
     * Darle formato a la respuesta de los endpoints
     *
     * @param array $data
     * @return Collection
     */
    public static function formatResponseData(Response $response) : Collection
    {
        $data = $response->collect();

        if($data->isEmpty() || !$data->has('data')) {
            return collect([]);
        }

        return collect($data->get('data'));
    }

    /**
     * Combina los datos de beneficios, filtros y fichas en una sola colección
     *
     * @param Collection $beneficios
     * @param Collection $filtros
     * @param Collection $fichas
     * @return Collection
     */
    public static function mergeResponseData(
        Collection $beneficios,
        Collection $filtros,
        Collection $fichas
    ) : Collection
    {
        $merged = $beneficios->map(function ($beneficio) use ($filtros, $fichas) {
            $filtro = $filtros->firstWhere('id_programa', $beneficio['id_programa']);
            $ficha = $fichas->firstWhere('id', $filtro['ficha_id']);

            $filtro['ficha'] = $ficha;
            $beneficio['filtro'] = $filtro;

            return $beneficio;
        });

        return $merged;
    }
}
