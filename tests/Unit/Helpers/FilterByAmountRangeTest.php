<?php

namespace Tests\Helpers\Unit;

use PHPUnit\Framework\TestCase;
use App\Helpers\BeneficiosCollectionHelper;
use Illuminate\Support\Collection;

class FilterByAmountRangeTest extends TestCase
{
    /**
     * Se prueba que se puedan filtrar beneficios según un rango de montos
     */
    public function test_can_filter_beneficios_by_amount_range(): void
    {
        $mockData = collect([
            ['monto' => 2000, 'filtro' => ['min' => 1000, 'max' => 5000]],
            ['monto' => 30000, 'filtro' => ['min' => 10000, 'max' => 20000]], // Se debe filtrar
            ['monto' => 2500, 'filtro' => ['min' => 500, 'max' => 1500]], // Se debe filtrar
            ['monto' => 500, 'filtro' => ['min' => 0, 'max' => 1000]]
        ]);

        $filtered = BeneficiosCollectionHelper::filterByAmountRange($mockData);

        $this->assertCount(2, $filtered);
        $this->assertEquals(2000, $filtered[0]['monto']);
        $this->assertInstanceOf(Collection::class, $filtered);
    }
}
