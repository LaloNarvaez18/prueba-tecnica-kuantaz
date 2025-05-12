<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

class BeneficiosCollectionHelper
{
    /**
     * Filtrar beneficios segun el rango de monto
     *
     * @param Collection $data
     * @return Collection
     */
    public static function filterByAmountRange(Collection $data) : Collection
    {
        return $data->filter(function ($item) {
            $amount = $item['monto'];
            $min = $item['filtro']['min'];
            $max = $item['filtro']['max'];

            return $amount >= $min && $amount <= $max;
        })->values();
    }

    /**
     * Agrupar beneficios por año de acuerdo a la fecha
     *
     * @param Collection $data
     * @return Collection
     */
    public static function groupByYear(Collection $data) : Collection
    {
        return $data->map(function ($item) {
            $item['year'] = array_key_exists('fecha', $item)
                ? Carbon::parse($item['fecha'])->year
                : 'undefined_year';

            return $item;
        })->sortByDesc('year')->groupBy('year');
    }

    /**
     * Mapear los datos requeridos para la respuesta
     *
     * @param Collection $data
     * @return Collection
     */
    public static function mapGroupData(Collection $data) : Collection
    {
        return $data->map(function ($items, $year) {
            return [
                'year' => $year,
                'monto_total' => $items->sum('monto'),
                'numero_beneficios' => $items->count(),
                'beneficios' => $items->map(function ($value) {
                    return [
                        'id_programa' => $value['id_programa'],
                        'monto' => $value['monto'],
                        'fecha_recepcion' => $value['fecha_recepcion'],
                        'fecha' => $value['fecha'],
                        'ano' => date('Y', strtotime($value['fecha'])),
                        'view' => true,
                        'ficha' => $value['filtro']['ficha'],
                    ];
                }),
            ];
        })->values();
    }
}
