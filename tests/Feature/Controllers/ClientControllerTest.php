<?php


namespace Feature\app\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    use DatabaseMigrations;


    public function setUp(): void
    {

        parent::setUp();
    }

    public function testIndexIfNotHaveClientInDatabase()
    {
        $response = $this->get('/api/clients');

        $response->assertStatus(200);
    }
}