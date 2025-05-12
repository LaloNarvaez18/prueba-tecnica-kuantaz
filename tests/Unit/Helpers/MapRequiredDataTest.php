<?php

namespace Tests\Helpers\Unit;

use PHPUnit\Framework\TestCase;
use App\Helpers\BeneficiosCollectionHelper;
use Illuminate\Support\Collection;

class MapRequiredDataTest extends TestCase
{
    /**
     * Se prueba que se mapeen los datos requeridos por año correctamente.
     */
    public function test_can_map_group_data_correctlly(): void
    {
        $mockData = collect([
            '2023' => collect([
                [
                    "id_programa" => 1,
                    "monto" => 12345,
                    "fecha_recepcion" => "01/01/2023",
                    "fecha" => "2023-01-01",
                    "filtro" => [
                        "id_programa" => 1,
                        "tramite" => "Lorem ",
                        "min" => 0,
                        "max" => 54321,
                        "ficha_id" => 10,
                        "ficha" => [
                            "id" => 10,
                            "nombre" => "Lorem",
                            "id_programa" => 1,
                            "url" => "Lorem",
                            "categoria" => "Lorem",
                            "descripcion" => "Lorem"
                        ]
                    ]
                ]
            ])
        ]);

        $mapped = BeneficiosCollectionHelper::mapGroupData($mockData);
        $firstGroup = $mapped->first();
        $firstBeneficio = $firstGroup['beneficios']->first();

        $this->assertArrayHasKey('year', $firstGroup);
        $this->assertArrayHasKey('monto_total', $firstGroup);
        $this->assertArrayHasKey('numero_beneficios', $firstGroup);
        $this->assertArrayHasKey('beneficios', $firstGroup);
        $this->assertArrayHasKey('ficha', $firstBeneficio);
        $this->assertInstanceOf(Collection::class, $mapped);
    }
}
