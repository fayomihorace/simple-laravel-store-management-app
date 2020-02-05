<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 
Route::get('/', 'HomeController@home')->name('home')->middleware('auth');
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('user/login', 'AuthController@login'  )->name('user/login');
Route::get('user/logout', 'AuthController@logout')->name('user/logout');

Route::get('get_name_by_id/{type}/{id}  ', 'RequestsController@get_name_by_id')->name('get_name_by_id');


//geststock_

Route::get('admin/operation/end/{id}', 'Admin\\OperationController@end')->middleware('auth');

Route::resource('admin/categorie', 'Admin\\CategorieController')->middleware('auth');
Route::resource('admin/magazin', 'Admin\\MagazinController')->middleware('auth');
Route::resource('admin/membre', 'Admin\\MembreController')->middleware('auth');
Route::resource('responsable', 'Adm\\ResponsableController')->middleware('auth');
Route::resource('admin/responsable', 'Admin\\ResponsableController')->middleware('auth');
Route::resource('admin/fournisseur', 'Admin\\FournisseurController')->middleware('auth');
Route::resource('admin/operation', 'Admin\\OperationController')->middleware('auth');
Route::resource('admin/produit-magazin', 'Admin\\ProduitMagazinController')->middleware('auth');
Route::resource('admin/mouvement', 'Admin\\MouvementController')->middleware('auth');
Route::resource('admin/ajout-stock', 'Admin\\AjoutStockController')->middleware('auth');
Route::resource('admin/produit', 'Admin\\ProduitController')->middleware('auth');
Route::resource('admin/image', 'Admin\\ImageController')->middleware('auth');
Route::resource('admin/image', 'Admin\\ImageController')->middleware('auth');