<?php

namespace App\Http\Handlers;

use Illuminate\Support\Facades\Http;

class BeneficiosApiHandler
{
    public function beneficios()
    {
        return Http::beneficiosApi()->get(env('BENEFICIOS_ENDPOINT'));
    }

    public function filtros()
    {
        return Http::beneficiosApi()->get(env('FILTROS_ENDPOINT'));
    }

    public function fichas()
    {
        return Http::beneficiosApi()->get(env('FICHAS_ENDPOINT'));
    }
}
