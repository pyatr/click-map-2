<?php

use App\Http\Controllers\DomainsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClicksController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/click-map', function () {
    return view('clickmap');
});

Route::post('/add-click', function () {
    //$_POST is empty for whatever reason
    $data = json_decode(file_get_contents("php://input"), true);
    $data['domain'] = $_SERVER['REMOTE_ADDR'];
    $clicksController = new ClicksController();
    $clicksController->addClick($data);
});

Route::post('/add-new-domain', function () {
    $data = json_decode(file_get_contents("php://input"), true);
    $domainController = new DomainsController();
    $domainController->addNewDomain($data);
});

Route::post('/delete-domain', function () {
    $data = json_decode(file_get_contents("php://input"), true);
    $data['domain'] = $_SERVER['REMOTE_ADDR'];
    $domainController = new DomainsController();
    $domainController->deleteDomain($data);
});

Route::get('/get-all-clicks', function () {
    $clicksController = new ClicksController();
    echo json_encode($clicksController->getAllClicks());
});

Route::get('/get-clicks-for-domain', function () {
    $data = json_decode(file_get_contents("php://input"), true);
    $data['domain'] = $_SERVER['REMOTE_ADDR'];
    $clicksController = new ClicksController();
    echo json_encode($clicksController->getClicksForDomain($data));
});

