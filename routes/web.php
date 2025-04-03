<?php
use App\Http\Controllers\controllerAchat;
use App\Http\Controllers\controllerentretien;
use App\Http\Controllers\controllerIndex;
use App\Http\Controllers\controllerProduct;
use App\Http\Controllers\controllerService;
use App\Http\Controllers\controllerentree;
use Illuminate\Support\Facades\Route;
use App\Models\Produit;


Route::redirect('/', 'index');


Route::get('index', [controllerIndex::class, 'showIndex'])
    ->name('index');


// Purchase
Route::get('list/purchase', [controllerAchat::class, 'showAchat_produit'])
    ->name('purchase');

Route::post('list/purchase', [controllerAchat::class, 'addAchat'])
    ->name('addPurchase');

Route::get('delete/purchase/{numAchat}', [controllerAchat::class, 'deleteAchat']);

Route::get('edit/purchase/{numAchat}', [controllerAchat::class, 'loadEditAchat']);

Route::post('edit/purchase', [controllerAchat::class, 'editAchat'])
    ->name('editPurchase');

Route::post('search/purchase', [controllerAchat::class, 'search'])
    ->name('searchPurchases');


// Product
Route::get('list/products', [controllerProduct::class, 'showProduit'])
    ->name('listProducts');

Route::post('list/products', [controllerProduct::class, 'addproduit'])
    ->name('addProduct');

Route::get('delete/products/{numProd}', [controllerProduct::class, 'deleteProduit']);

Route::get('edit/products/{numProd}', [controllerProduct::class, 'loadEditProduit']);

Route::post('edit/products', [controllerProduct::class, 'editProduit'])
    ->name('editProduct');


// Service
Route::get('list/services', [controllerService::class, 'showServices'])
    ->name('listServices');

Route::post('add/services', [controllerService::class, 'addService'])
    ->name('addService');

Route::get('delete/services/{numServ}', [controllerService::class, 'deleteService']);

Route::get('edit/services/{numServ}', [controllerService::class, 'loadEditService']);

Route::post('edit/service', [controllerService::class, 'editService'])
    ->name('editService');


// Maintenance
Route::get('list/maintenances', [controllerentretien::class, 'showEntretienList_nomService'])
    ->name('maintenance');

Route::post('list/maintenances', [controllerentretien::class, 'saveEntretien'])
    ->name('addMaintenance');

Route::get('delete/maintenances/{numEntr}', [controllerentretien::class, 'deleteMaintenance']);

Route::get('edit/maintenances/{numEntree}', [controllerentretien::class, 'loadEditEntretien']);

Route::post('edit/maintenance', [controllerentretien::class, 'editEntretien'])
    ->name('editMaintenance');

Route::post('search/maintenances', [controllerentretien::class, 'search'])
    ->name('searchMaintenances');

Route::post('list/maintenance/filter', [controllerentretien::class, 'filterMaintenancesClientList'])
    ->name('filterMaintenances');

Route::get('bill/maintenances/{numEntretien}', [controllerentretien::class, 'generateBill'])
    ->name('billMaintenances');


// Entry
Route::get('list/entry', [controllerentree::class, 'showentre_produit'])
    ->name('entry');

Route::post('add/entry', [controllerentree::class, 'addEntree'])
    ->name('addEntry');

Route::get('delete/entry/{numEntree}', [controllerentree::class, 'deleteEntree']);

Route::get('edit/entry/{numEntre}', [controllerentree::class, 'loadeditEntree']);

Route::post('edit/entry', [controllerentree::class, 'editEntree'])
    ->name('editEntry');

