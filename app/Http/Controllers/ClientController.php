<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller {
    public function index() {
        return ClientRepository::index();
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


        $clientExists = ClientRepository::getClientByDocument($requestBody['document']);

        if($clientExists) {
            return response()->json([
                'message' => 'Client already exists'
            ], 409);
        }

        return ClientRepository::store($requestBody);

    }

    public function show($id) {
        return ClientRepository::show($id);
    }

    public function update(Request $request, $id) {
        $requestBody = $request->json()->all();

        return ClientRepository::update($requestBody, $id);
    }

    public function destroy($id) {
        return ClientRepository::destroy($id);
    }

    
}