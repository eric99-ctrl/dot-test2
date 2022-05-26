<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_import_provinces()
    {
        $response = $this->get('api/province/import');
        $response->assertStatus(200);
    }

    public function test_import_cities()
    {
        $response = $this->get('api/city/import');
        $response->assertStatus(200);
    }

    public function test_swab_cities_from_api()
    {
        $response = $this->get('api/swab/search/cities', ['id' => 1 , 'fromAPI' => true]);
        $response->assertSessionMissing('errors');
    }

    public function test_swab_cities_from_database()
    {
        $response = $this->get('api/swab/search/cities', ['id' => 1 , 'fromAPI' => false]);
        $response->assertSessionMissing('errors');
    }

    public function test_swab_provinces_from_api()
    {
        $response = $this->get('api/swab/search/provinces', ['id' => 1 , 'fromAPI' => true]);
        $response->assertSessionMissing('errors');
    }

    public function test_swab_provinces_from_database()
    {
        $response = $this->get('api/swab/search/provinces', ['id' => 1 , 'fromAPI' => false]);
        $response->assertSessionMissing('errors');
    }

    public function test_kogin()
    {
        $formdata = [
            'email' => 'admin@google.com',
            'password' => 'secret'
        ];
        $response = $this->post('/api/login', $formdata);
        $response->assertSessionMissing('errors');
    }
}
