<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{
    public function index()
    {
        return Client::all();
    }

    public function store($requestBody)
    {
        try {

            $client = new Client($requestBody);
            $client->save();
            return $client;
        } catch (\Throwable $th) {
            return [
                "message" => "Error on create client",
                "error" => $th->getMessage()
            ];
        }
    }

    public function show($id)
    {
        try {
            $client = Client::find($id);
            if ($client) {
                return $client;
            } else {
                return [
                    "message" => "Client not found"
                ];
            }
        } catch (\Throwable $th) {
            return [
                "message" => "Error on show client",
                "error" => $th->getMessage()
            ];
        }
    }

    public function update($requestBody, $id)
    {
        try {
            $client = Client::find($id);
            if ($client) {
                $client->fill($requestBody);
                $client->save();
                return $client;
            } else {
                return [
                    "message" => "Client not found"
                ];
            }
        } catch (\Throwable $th) {
            return [
                "message" => "Error on update client",
                "error" => $th->getMessage()
            ];
        }
    }

    public function destroy($id)
    {
        try {
            $client = Client::find($id);
            if ($client) {
                $client->delete();
                return [
                    "message" => "Client deleted"
                ];
            } else {
                return [
                    "message" => "Client not found"
                ];
            }
        } catch (\Throwable $th) {
            return [
                "message" => "Error on delete client",
                "error" => $th->getMessage()
            ];
        }
    }

    public function getClientByDocument($document)
    {
        return Client::where('document', $document)->first();
    }

    public function getClientById($id)
    {
        return Client::where('id', '=', $id)->first();
    }

}
