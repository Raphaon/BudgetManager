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

//Route::get('/', 'StatistiquesController@index');


Route::get('/', [
    'as'   => 'home',
    'uses' => 'StatistiquesController@index'
]);

Route::get('/login', [
    'as'   => 'login',
    'uses' => 'SessionController@index'
]);

Route::get('/logout', [
    'as'   => 'logout',
    'uses' => 'SessionController@logout'
]);

Route::get('/users', [
    'as'   => 'users',
    'uses' => 'UsersController@index'
]);



Route::get('/pdfHeader', [
    'as'   => 'pdfHeader',
    'uses' => 'UsersController@pdfHeader'
]);



Route::get('/users/new', [
    'as'   => 'new_user',
    'uses' => 'UsersController@new'
]);

Route::get('/agence', [
    'as'   => 'agence',
    'uses' => 'AgenceController@index'
]);

Route::get('/realisation', [
    'as' => 'realisation',
    'uses' => 'RealisationController@index'
]);

Route::post('/mysession', [
    'as' => 'session',
    'uses' => 'SessionController@loginCheck'
]);

Route::get('/loadSession', [
    'as' => 'session_load',
    'uses' => 'SessionController@loadSession'
]);

Route::get('/realisation/new', [
    'as' => 'sortiefonds',
    'uses' => 'RealisationController@create'
]);

Route::get('/printConsonEncours', [
    'as' => 'pdfConsoEncours',
    'uses' => 'StatistiquesController@PrintConsoEncours'
]);

Route::get('/statistiqueParMois', [
    'as' => 'statistiqueParmois',
    'uses' => 'StatistiquesController@bilanDesMoisPasse'
]);

Route::get('/statistiqueParMoisPDf', [
    'as' => 'statistiqueParmoisPDF',
    'uses' => 'StatistiquesController@bilanConsoMois'
]);


Route::get('/consoEncours', [
    'as' => 'ConsoEncours',
    'uses' => 'StatistiquesController@consoEncours'
]);

Route::get('/enDepassement', [
    'as' => 'postEnDepassement',
    'uses' => 'StatistiquesController@postEnDepassementParMois'
]);

Route::get('/enDepassementPDF', [
    'as' => 'postEnDepassementPDF',
    'uses' => 'StatistiquesController@postEnDepassementPDF'
]);

Route::post('/enDepassement', [
    'as' => 'postEnDepassement',
    'uses' => 'StatistiquesController@enDepassement'
]);


Route::post('/agence', [
    'as' => 'agence',
    'uses' => 'AgenceController@index'
]);


Route::get('/employe', [
    'as' => 'employes',
    'uses' => 'EmployeController@index'
]);




Route::get('/suiviecompte', [
    'as' => 'suiviCompte',
    'uses' => 'CompteController@index'
]);








Route::get('/prevision', [
    'as' => 'prevision',
    'uses' =>'PrevisionController@index'
]);

Route::post('/prevision', [
    'as' => 'prevision',
    'uses' =>'PrevisionController@index'
]);

Route::get('/realisation/validation', [
    'as' => 'formValidation',
    'uses' =>'RealisationController@newValisationPDF'
]);

Route::get('/prevision/new', [
    'as' => 'nouvellePrevision',
    'uses' =>'PrevisionController@create'
]);

Route::get('/postbudgetaire', [
    'as' => 'postbudgetaire',
    'uses' =>'PostBudgetaireController@Index'
]);

Route::get('/categorie', [
    'as' => 'categorie',
    'uses' =>'CategorieController@index'
]);

Route::post('/prevision', [
    'as' => 'prevision',
    'uses' =>'PrevisionController@index'
]);

Route::get('/exercice', [
    'as' => 'exercice',
    'uses' =>'ExerciceController@index'
]);

Route::get('/realisation/printAll', [
    'as' => 'listReaAll',
    'uses' =>'RealisationController@listeImprimable'
]);

Route::get('/realisation/preValidation', [
    'as' => 'Prevalidation',
    'uses' =>'RealisationController@PrintPreview'
]);

Route::post('/realisation/preValidation', [
    'as' => 'Prevalidation',
    'uses' =>'RealisationController@printPreValidation'
]);

Route::post('/realisation/new', [
    'as' => 'sortieTraitment',
    'uses' =>'RealisationController@insert'
]);

Route::get('/realisation/search',[
    'as' => 'rechercheRealisation',
    'uses' => 'RealisationController@search'
]);

Route::get('/realisation/import',[
    'as' => 'importrealisation',
    'uses' => 'RealisationController@import'
]);

Route::post('/realisation/import',[
    'as' => 'importrealisation',
    'uses' => 'RealisationController@importTraitement'
]);

Route::post('/realisation/update',[
    'as' => 'updateRealisation',
    'uses' => 'RealisationController@update'
]);

Route::get('/prevision/export',[
    'as' => 'exporterPrevision',
    'uses' => 'PrevisionController@export'
]);


Route::get('/prevision/import',[
    'as' => 'importerPrevision',
    'uses' => 'PrevisionController@import'
]);


Route::get('/realisation/searchView',[
    'as' => 'SearchPrintPdf',
    'uses' => 'RealisationController@printSearchpdf'
]);

Route::post('/prevision/import',[
    'as' => 'import_previ',
    'uses' => 'PrevisionController@importTraitement'
]);
Route::get('/agence', 'AgenceController@index');
Route::get('/addBranch', 'AgenceController@store');


Route::get('/postbudgetaire/new', [
    'as' => 'nouveauPost',
    'uses' => 'PostBudgetaireController@create'
]);

Route::post('/postbudgetaire/import', [
    'as' => 'import_post',
    'uses' => 'PostBudgetaireController@import_process'
]);

Route::get('/postbudgetaire/import', [
    'as' => 'import_post',
    'uses' => 'PostBudgetaireController@import'
]);

Route::get('/realisation/delete/{slug}',[
    'as' => 'deletePrevision',
    'uses' => 'RealisationController@delete'
]);

Route::get('/realisation/view/{slug}', 'RealisationController@showDetail');
Route::get('/postbudgetaire/view/{id}', 'PostBudgetaireController@show');
Route::get('/postbudgetaire/edit/{id}', 'PostBudgetaireController@edit');
Route::get('/postbudgetaire/delete/{id}', 'PostBudgetaireController@delete');

Route::get('/postbudgetaire/export', 'PostBudgetaireController@export');
Route::get('/updateBranch', 'AgenceController@update');

Route::get('/Exercice/Archiver', 'ExerciceController@index');
Route::get('/exercice/archiver', 'ExerciceController@index');
Route::get('/Exercice/Cloturer', 'ExerciceController@index');
Route::get('/exercice/cloturer', 'ExerciceController@close');




//Route::get('/importer', 'PostBudgetaireController@importer');
//Route::get('/export', 'AgenceController@exportdata');


Route::post('/importeprocess', 'PostBudgetaireController@importer_process');
Route::post('/exercice/create', 'ExerciceController@store');
Route::post('/updateCategorie', 'CategorieController@update');
Route::post('/addCategorie', 'CategorieController@store');
Route::post('/deleteBranch', 'AgenceController@delete');
Route::post('/updateBranch', 'AgenceController@update');
Route::post('/addBranch', 'AgenceController@store');
Route::post('/realisation/search', 'RealisationController@find');
Route::post('/postbudgetaire/new', 'PostBudgetaireController@store');
Route::post('/prevision/new', 'PrevisionController@store');
Route::post('/realisation/store', 'RealisationController@store');



Route::get('/new/Account', [
    'as' => 'newAccount',
    'uses' => 'CompteController@create'
]);


Route::post('/new/Account', [
    'as' => 'storeAccount',
    'uses' => 'CompteController@store'
]);