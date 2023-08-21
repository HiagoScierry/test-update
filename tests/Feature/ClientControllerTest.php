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


        //act

        $response = $this->post('/api/clients/', $client->toArray());


        //assert
        $response->assertStatus(201);
        $response->assertJsonCount(1);

    }

    public function test_store_if_send_same_document_in_body(): void
    {
        //arrange
        $client = Client::factory()->create();

        //act
        $response = $this->post('/api/clients/', $client->toArray());

        //assert
        $response->assertStatus(409);
        $response->assertJsonCount(1);
    }

    public function test_show_if_client_not_exists(): void
    {
        //arrange
        $clientID = 1;

        //act
        $response = $this->get('/api/clients/'. $clientID);

        //assert
        $response->assertStatus(409);
        $response->assertJson(['message' => 'Client not exists']);
    }

    public function test_show_if_client_exists(): void
    {
        //arrange
        $client = Client::factory()->create();
        $clientID = 1;

        //act
        $response = $this->get('/api/clients/'. $clientID);

        //assert

        $response->assertStatus(200);

    }

    public function test_update_if_client_not_exists(): void
    {
        //arrange
        $clientID = 1;
        $client = Client::factory()->make();

        //act
        $response = $this->put('/api/clients/'. $clientID, $client->toArray());

        //assert
        $response->assertStatus(409);
        $response->assertJson(['message' => 'Client not exists']);
    }

    public function test_update_if_client_exists(): void
    {
        //arrange
        $client = Client::factory()->create();
        $clientID = 1;

        $payload = [
            'name' => 'Hiago Moreira',
            'document' => '123.456.789-10',
            'sex' => 'M',
            'birth_date' => '1999-04-07',
            'address' => 'Rua 1',
            'city' => 'Cidade 1',
            'state' => 'SP'

        ];

        //act
        $response = $this->put('/api/clients/'. $clientID, $payload);

        //assert
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Client updated successfully']);
    }

    public function test_update_customer_if_it_changes_to_an_existing_document_in_the_database(): void {
        //arrange

        Client::factory()->create();
        $client = Client::factory()->create();

        $clientID = 1;

        $payload = [
            'name' => 'Hiago Moreira',
            'document' => $client->document,
            'sex' => 'M',
            'birth_date' => '1999-04-07',
            'address' => 'Rua 1',
            'city' => 'Cidade 1',
            'state' => 'SP'
        ];

        //act

        $response = $this->put('/api/clients/'. $clientID, $payload);

        //assert

        $response->assertStatus(409);
        $response->assertJson(['message' => 'Client document already exists']);

    }


    public function test_delete_client_if_not_exists(): void
    {
        //arrange
        $clientID = 1;

        //act
        $response = $this->delete('/api/clients/'. $clientID);

        //assert
        $response->assertStatus(409);
        $response->assertJson(['message' => 'Client not exists']);
    }

    public function test_delete_client_if_exists() : void
    {
        //arrange
        $client = Client::factory()->create();
        $clientID = 1;

        //act
        $response = $this->delete('/api/clients/'. $clientID);

        //assert
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Client deleted successfully']);
    }

}
