<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_if_do_not_have_client_in_table(): void
    {
        //arrange

        //act
        $response = $this->get('/api/clients');

        //assert

        $response->assertStatus(200);
        $response->assertJson([]);
    }

    public function test_index_if_have_client_in_table(): void
    {
       
        //arrange


        //act
        $client = Client::factory()->create();


        $response = $this->get('/api/clients');
        //assert
        $response->assertStatus(200);
        $response->assertJsonCount(1);


    }

    public function test_store_insert_data(): void
    {
        //arrange
        $client = Client::factory()->make();

        $this->assertDatabaseCount('clients', 0);

        //act

        $response = $this->post('/api/clients', $client->toArray());
        echo ClientRepository::index();
        
        //assert
        $response->assertStatus(200);
    }

    public function test_show_if_client_exists(): void
    {
        //arrange
        $client = Client::factory()->create();

        //act
        $response = $this->get('/api/clients/' . $client->id);

        //assert
        $response->assertStatus(200);
        $response->assertJson($client->toArray());
    }

}
