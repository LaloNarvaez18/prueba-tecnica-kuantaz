<?php

namespace Tests\Unit\Repositories;

use PHPUnit\Framework\TestCase;
use App\Http\Repositories\BeneficioRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class BeneficiosRepositoryTest extends TestCase
{
    /**
     * Testing API URL is set in the BeneficioRepository.
     */
    public function test_api_url_is_set(): void
    {
        $beneficioRepository = new BeneficioRepository();
        $this->assertNotEmpty($beneficioRepository->apiUrl);
    }
}
