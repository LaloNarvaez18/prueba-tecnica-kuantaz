<?php

namespace Tests\Helpers\Unit;

use PHPUnit\Framework\TestCase;
use App\Helpers\BeneficiosCollectionHelper;
use Illuminate\Support\Collection;

class GroupDataByYearTest extends TestCase
{
    /**
     * Se prueba que los beneficios se agrupan correctamente por año.
     */
    public function test_can_group_beneficios_by_year(): void
    {
        $mockData = collect([
            ['monto' => 2000, 'fecha' => '2022-01-01', 'filtro' => ['min' => 1000, 'max' => 5000]],
            ['monto' => 30000, 'fecha' => '2022-02-01', 'filtro' => ['min' => 10000, 'max' => 20000]], // Se debe filtrar
            ['monto' => 2500, 'fecha' => '2023-03-01', 'filtro' => ['min' => 500, 'max' => 1500]], // Se debe filtrar
            ['monto' => 500, 'fecha' => '2024-04-01', 'filtro' => ['min' => 0, 'max' => 1000]]
        ]);

        $helper = new BeneficiosCollectionHelper();
        $grouped = $helper::groupByYear($mockData);

        $this->assertCount(3, $grouped);
        $this->assertArrayHasKey('2022', $grouped);
        $this->assertArrayHasKey('2023', $grouped);
        $this->assertArrayHasKey('2024', $grouped);
    }

    /**
     * Se prueba que los beneficios agrupados por año se ordenen de forma descendente.
     */
    public function test_grouped_beneficios_are_sorted_desc(): void
    {
        $mockData = collect([
            ['monto' => 2000, 'fecha' => '2022-01-01', 'filtro' => ['min' => 1000, 'max' => 5000]],
            ['monto' => 30000, 'fecha' => '2022-02-01', 'filtro' => ['min' => 10000, 'max' => 20000]], // Se debe filtrar
            ['monto' => 2500, 'fecha' => '2023-03-01', 'filtro' => ['min' => 500, 'max' => 1500]], // Se debe filtrar
            ['monto' => 500, 'fecha' => '2024-04-01', 'filtro' => ['min' => 0, 'max' => 1000]]
        ]);

        $helper = new BeneficiosCollectionHelper();
        $grouped = $helper::groupByYear($mockData);

        $this->assertEquals('2024', $grouped->keys()->first());
    }

    /**
     * Se prueba se agrupan los beneficios que no tienen el atributo 'fecha'
     */
    public function test_can_group_beneficios_without_date(): void
    {
        $mockData = collect([
            ['monto' => 2000, 'filtro' => ['min' => 1000, 'max' => 5000]],
            ['monto' => 30000, 'fecha' => '2022-02-01', 'filtro' => ['min' => 10000, 'max' => 20000]],
            ['monto' => 2500, 'filtro' => ['min' => 500, 'max' => 1500]],
            ['monto' => 500, 'fecha' => '2024-04-01', 'filtro' => ['min' => 0, 'max' => 1000]]
        ]);

        $helper = new BeneficiosCollectionHelper();
        $grouped = $helper::groupByYear($mockData);

        $this->assertCount(3, $grouped);
        // Los beneficios sin fecha se agrupan como undefined_date
        $this->assertArrayHasKey('undefined_year', $grouped);
    }

    /**
     * Se prueba que el grupo de beneficios retornado sea una Collection
     */
    public function test_returns_collection() : void
    {
        $mockData = collect([
            ['monto' => 2000, 'fecha' => '2022-01-01', 'filtro' => ['min' => 1000, 'max' => 4000]],
            ['monto' => 4000, 'fecha' => '2023-02-02', 'filtro' => ['min' => 0, 'max' => 5000]]
        ]);

        $grouped = BeneficiosCollectionHelper::groupByYear($mockData);

        $this->assertInstanceOf(Collection::class, $grouped);
    }
}
