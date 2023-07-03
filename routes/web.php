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
    return view('home');
});

Route::get('/click-test', function () {
    return view('clicktest');
});

Route::get('/click-tracked', function () {
    return view('tracked');
});

Route::get('/click-map', function () {
    return view('clickmap');
});

Route::get('/click-hours', function () {
    return view('clickhours');
});

Route::post('/add-click', function () {
    //$_POST is empty for whatever reason
    $data = json_decode(file_get_contents("php://input"), true);
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
    $domainController = new DomainsController();
    $domainController->deleteDomain($data);
});

Route::get('/get-all-clicks', function () {
    $clicksController = new ClicksController();
    echo json_encode($clicksController->getAllClicks());
});

Route::get('/get-tracked-domains', function () {
    $domainsController = new DomainsController();
    echo json_encode($domainsController->getAllDomains());
});

Route::get('/get-clicks-for-domain', function () {
    $clicksController = new ClicksController();
    echo json_encode($clicksController->getClicksForDomain());
});

