<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class BeneficiosCollectionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerBeneficiosFilterMacro();
        $this->registerBeneficiosGroupByMacro();
        $this->registerBeneficiosMapMacro();
    }

    /**
     * Macro para filtrar los beneficios por rango de monto.
     *
     * @return void
     */
    private function registerBeneficiosFilterMacro()
    {
        Collection::macro('filterByAmountRange', function () {
            return $this->filter(function ($item) {
                $filter = $item['filtro'];
                $amount = $item['monto'];
                $min = $filter['min'];
                $max = $filter['max'];

                if($amount >= $min && $amount <= $max) {
                    return $item;
                }
            })->values();
        });
    }

    /**
     * Macro para agrupar los beneficios por año.
     *
     * @return void
     */
    private function registerBeneficiosGroupByMacro()
    {
        Collection::macro('groupByYear', function () {
            return $this->map(function ($item) {
                $item['year'] = \Carbon\Carbon::parse($item['fecha'])->year;
                return $item;
            })->sortByDesc('year')->groupBy('year');
        });
    }

    /**
     * Macro para mapear los datos requeridos de los beneficios.
     *
     * @return void
     */
    private function registerBeneficiosMapMacro()
    {
        Collection::macro('mapRequiredData', function () {
            return $this->map(function ($items, $year) {
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
        });
    }
}
