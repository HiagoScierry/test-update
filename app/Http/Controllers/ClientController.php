<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller {

    private $clientRepository;

    public function __construct(ClientRepository $clientRepository) {
        $this->clientRepository = $clientRepository;
    }


    public function index() {
        return response()->json($this->clientRepository->index() , 200);
    }

    public function store(Request $request) {
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


        $clientExists = $this->clientRepository->getClientByDocument($requestBody['document']);

        if($clientExists) {
            return response()->json([
                'message' => 'Client already exists'
            ], 409);
        }

        $this->clientRepository->store($requestBody);

        return response()->json([
            'message' => 'Client created successfully'
        ], 201);

    }

    public function show($id) {
        return response()->json($this->clientRepository->show($id), 200);
    }

    public function update(Request $request, $id) {
        $requestBody = $request->json()->all();

        $clientExists = $this->clientRepository->getClientById($id);

        if(!$clientExists) {
            return response()->json([
                'message' => 'Client not exists'
            ], 409);
        }

        $clientDocumentExists = $this->clientRepository->getClientByDocument($requestBody['document']);

        if($clientDocumentExists) {
            return response()->json([
                'message' => 'Client document already exists'
            ], 409);
        }

        $this->clientRepository->update($requestBody, $id);

        return response()->json([
            'message' => 'Client updated successfully'
        ], 200);

    }

    public function destroy($id) {

        $clientExists = $this->clientRepository->getClientById($id);

        if(!$clientExists) {
            return response()->json([
                'message' => 'Client not exists'
            ], 409);
        }

        $this->clientRepository->destroy($id);

        return response()->json([
            'message' => 'Client deleted successfully'
        ], 200);
    }

    
}