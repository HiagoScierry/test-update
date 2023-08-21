<?php

use App\Http\Controllers\ClientController;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function PHPSTORM_META\map;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {

    $queryFilters = [
        "name" => $request->query('name') ,
        "document" => $request->query('document') ,
        "sex" => $request->query('sex') ,
        "state" => $request->query('state') ,
        "city" => $request->query('city') ,
        "birth_date" => $request->query('birth_date') ,
    ];

    $clientRepository = new ClientRepository();
    $clientController = new ClientController($clientRepository);
    $data = $clientController->index($queryFilters);



    return view('listClients', ['clients' => $data->getData()]);
});
