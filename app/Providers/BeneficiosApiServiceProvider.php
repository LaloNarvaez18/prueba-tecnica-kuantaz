<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use App\Http\Services\BeneficiosApiService;

class BeneficiosApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('BeneficiosApiService', function ($app) {
            return new BeneficiosApiService(new BeneficiosApiHandler);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerFetchMacro();
    }

    /**
     * Register the fetch macro.
     *
     * @return void
     */
    protected function registerFetchMacro()
    {
        Http::macro('beneficiosApi', function () {
            return Http::withHeaders([
                    'Accept' => 'application/json'
                ])->baseUrl(env('BENEFICIOS_API_BASE_URL'));
        });
    }
}
