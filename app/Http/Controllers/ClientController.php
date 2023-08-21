<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller {
    public function index() {
        return ClientRepository::index();
    }

    public function store(Request $request) {
        $requestBody = $request->json()->all();

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