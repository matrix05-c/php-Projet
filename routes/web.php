<?php
use App\Http\Controllers\controllerAchat;
use App\Http\Controllers\controllerentretien;
use App\Http\Controllers\controllerIndex;
use App\Http\Controllers\controllerProduct;
use App\Http\Controllers\controllerService;
use App\Http\Controllers\controllerentree;
use Illuminate\Support\Facades\Route;
use App\Models\Produit;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/index', [controllerIndex::class, 'showIndex'])
    ->name('index');



Route::get('list/purchase', [controllerAchat::class, 'showAchat_produit'])
    ->name('purchase');

Route::post('list/purchase', [controllerAchat::class, 'addAchat'])
    ->name('addAchat');

Route::get('delete/purchase/{numAchat}', [controllerAchat::class, 'deleteAchat']);

Route::get('modifie/purchase/{numAchat}', [controllerAchat::class, 'loadEditAchat']);

Route::post('edit-purchase', [controllerAchat::class, 'editAchat'])
    ->name('modifieAchat');

Route::post('list/purcha', [controllerAchat::class, 'search'])
    ->name('searchAchat');



Route::get('/list/products', [controllerProduct::class, 'showProduit'])
    ->name('list_products');

Route::post('list/products', [controllerProduct::class, 'addproduit'])
    ->name('addProducts');

Route::get('delete/products/{numProd}', [controllerProduct::class, 'deleteProduit']);

Route::get('modifie/products/{numProd}', [controllerProduct::class, 'loadEditProduit']);

Route::post('delete/produitt', [controllerProduct::class, 'editProduit'])
    ->name('modifieProduit');




Route::get('/list/services', [controllerService::class, 'showServices'])
    ->name('list_services');

Route::post('/add/services', [controllerService::class, 'addService'])
    ->name('addServices');

Route::get('delete/services/{numServ}', [controllerService::class, 'deleteService']);

Route::get('modifie/services/{numServ}', [controllerService::class, 'loadEditService']);

Route::post('EditService', [controllerService::class, 'editService'])
    ->name('modifieService');




Route::get('/list/maintenances', [controllerentretien::class, 'showEntretienList_nomService'])
    ->name('maintenance');

Route::post('/list/maintenances', [controllerentretien::class, 'saveEntretien'])
    ->name('addMaintenance');

Route::get('delete/maintenances/{numEntr}', [controllerentretien::class, 'deleteMaintenance']);

Route::get('modifie/maintenances/{numEntree}', [controllerentretien::class, 'loadEditEntretien']);

Route::post('/editMaintenance', [controllerentretien::class, 'editEntretien'])
    ->name('modifieEntretien');

Route::post('searchEntretien', [controllerentretien::class, 'search'])->name('serachEntretien');



Route::get('/list/Entree', [controllerentree::class, 'showentre_produit'])
    ->name('Entree');

Route::post('/addEntree', [controllerentree::class, 'addEntree'])
    ->name('AddEntree');

Route::get('delete/Entree/{numEntree}', [controllerentree::class, 'deleteEntree']);

Route::get('modifie/Entree/{numEntre}', [controllerentree::class, 'loadeditEntree']);

Route::post('modifieEntree', [controllerentree::class, 'editEntree'])
    ->name('editEntree');


