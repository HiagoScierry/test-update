<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return response()->json(ClientRepository::index(), 200);
    }

    public function store(Request $request)
    {
        $requestBody = $request->json()->all();

        $this->validate($request, [
            'name' => 'required|max:100',
            'document' => 'required|max:14',
            'birth_date' => 'required:date',
            'sex' => 'required:max:1',
            'address' => 'required: max:100',
            'city' => 'required: max:100',
            'state' => 'required:2'
        ]);


        $clientExists = ClientRepository::getClientByDocument($requestBody['document']);

        if ($clientExists) {
            return response()->json([
                'message' => 'Client already exists'
            ], 409);
        }

        ClientRepository::store($requestBody);

        return response()->json([
            'message' => 'Client created successfully'
        ], 201);
    }

    public function show($id)
    {
        return response()->json(ClientRepository::show($id), 200);
    }

    public function update(Request $request, $id)
    {
        $requestBody = $request->json()->all();

        $clientExists = ClientRepository::getClientById($id);

        if (!$clientExists) {
            return response()->json([
                'message' => 'Client not exists'
            ], 409);
        }

        $clientDocumentExists = ClientRepository::getClientByDocument($requestBody['document']);

        if ($clientDocumentExists) {
            return response()->json([
                'message' => 'Client document already exists'
            ], 409);
        }

        ClientRepository::update($requestBody, $id);

        return response()->json([
            'message' => 'Client updated successfully'
        ], 200);
    }

    public function destroy($id)
    {

        $clientExists = ClientRepository::getClientById($id);

        if (!$clientExists) {
            return response()->json([
                'message' => 'Client not exists'
            ], 409);
        }

        ClientRepository::destroy($id);

        return response()->json([
            'message' => 'Client deleted successfully'
        ], 200);
    }
}
