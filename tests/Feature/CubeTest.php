<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CubeTest extends TestCase
{
    /**
     * @test
     */
    function cube_loads_main_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Welcome to Cube Summation page');
    }

    /**
     * @test
     */
    function cube_loads_create()
    {
        $response = $this->post('/cube',["matrix_dimension" => 4, "quantity_commands" => 5]);
        $response->assertStatus(201);
        $response->assertSee('success');
    }

    /**
     * @test
     */
    function cube_loads_get()
    {
        $response = $this->get('/cube');
        $response->assertStatus(200);
        $response->assertSee('success');
    }

    /**
     * @test
     */
    function cube_loads_delete()
    {
        $response = $this->delete('/cube');
        $response->assertStatus(200);
        $response->assertSee('success');
    }

    /**
     * @test
     */
    function cube_loads_update()
    {
        $response = $this->post('/cube/update', ["x" => 1, "y" => 1, "z" => 1, "value"=> 23]);
        $response->assertStatus(200);
        $response->assertSee('success');
    }

    /**
     * @test
     */
    function cube_loads_query()
    {
        $response = $this->post('/cube/query');
        $response->assertStatus(200);
        $response->assertSee('success');
    }
}
