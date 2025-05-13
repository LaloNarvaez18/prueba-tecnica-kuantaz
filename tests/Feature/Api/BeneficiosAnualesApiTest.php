<?php

namespace Tests\Api\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BeneficiosAnualesApiTest extends TestCase
{
    /**
     * Prueba que verifica que la API de beneficios anuales responde correctamente
     */
    public function test_beneficios_anuales_endpoint_responds_successfuly(): void
    {
        $response = $this->get('api/v1/beneficios/anuales');

        $expectedKeys = [
            'data' => [
                '*' => [
                    'year',
                    'monto_total',
                    'numero_beneficios',
                    'beneficios' => [
                        '*' => [
                            'id_programa',
                            'monto',
                            'fecha_recepcion',
                            'fecha',
                            'ano',
                            'view',
                            'ficha' => [
                                'id',
                                'nombre',
                                'id_programa',
                                'url',
                                'categoria',
                                'descripcion'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response
            ->assertStatus(200)
            ->assertJson([
                'code' => 200,
                'success' => true
            ])
            ->assertJsonStructure($expectedKeys);
    }
}
