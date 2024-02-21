<?php

use Illuminate\Support\Facades\Route;

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

$controller_path = 'App\Http\Controllers';

Route::group(['prefix' => '{bank:url}', 'middleware' => ['auth', 'bank_user']], function () use ($controller_path) {
  Route::get('/', $controller_path . '\DashboardController@index')->name('dashboard');

  // Requests
  Route::get('/requests/reverse-factoring', $controller_path . '\RequestsController@reverseFactoring')->name('requests-reverse-factoring');
  Route::get('/requests/factoring', $controller_path . '\RequestsController@factoring')->name('requests-factoring');
  Route::get('/requests/payment-requests', $controller_path . '\RequestsController@requests')->name('payment-requests');

  // Companies
  Route::get('/companies', $controller_path . '\CompanyController@index')->name('companies.index');
  Route::get('/companies/create', $controller_path . '\CompanyController@create')->name('companies.create');
  Route::post('/companies/store', $controller_path . '\CompanyController@store')->name('companies.store');
  Route::get('/companies/{company}/details', $controller_path . '\CompanyController@show')->name('companies.show');
  Route::get('/companies/pending/{pipeline}/details', $controller_path . '\CompanyController@showPending')->name('companies.pending.show');
  Route::get('/companies/{company}/status/update/{status}', $controller_path . '\CompanyController@updateStatus')->name('companies.status.update');
  Route::post('/companies/{company}/document/status/update', $controller_path . '\CompanyController@updateDocumentStatus')->name('companies.documents.status.update');
  Route::post('/pipelines/pending/{pipeline}/status/update', $controller_path . '\CompanyController@updatePipelineCompanyStatus')->name('pipelines.pending.status.update');
  Route::post('/pipelines/pending/{pipeline}/document/status/update', $controller_path . '\CompanyController@updatePendingDocumentStatus')->name('pipelines.pending.documents.status.update');
  Route::post('/companies/{company}/documents/request', $controller_path . '\CompanyController@requestDocuments')->name('companies.documents.request');

  // Programs
  Route::get('/programs/create', $controller_path . '\ProgramController@create')->name('programs.create');
  Route::post('/programs/store', $controller_path . '\ProgramController@store')->name('programs.store');
  Route::get('/programs/{status?}', $controller_path . '\ProgramController@index')->name('programs.index');
  Route::get('/programs/{program}/details', $controller_path . '\ProgramController@show')->name('programs.show');
  Route::get('/programs/{program}/update/status/{status}', $controller_path . '\ProgramController@updateStatus')->name('programs.status.update');
  Route::get('/programs/{program}/vendor/map', $controller_path . '\ProgramController@showMapVendor')->name('programs.vendors.map');
  Route::post('/programs/{program}/vendor/map', $controller_path . '\ProgramController@mapVendor')->name('programs.vendors.map.store');

  // Reports
  Route::get('/reports', $controller_path . '\ReportsController@index')->name('reports.index');
  Route::get('/reports/ledger', $controller_path . '\ReportsController@ledger')->name('reports.ledger');

  // Configrations
  Route::get('/configurations', $controller_path . '\ConfigurationsController@index')->name('configurations.index');
  Route::post('/configurations/compliance/document/add', $controller_path . '\ConfigurationsController@addComplianceDocument')->name('configurations.compliance.document.add');
  Route::post('/configurations/compliance/documents/update', $controller_path . '\ConfigurationsController@updateComplianceDocuments')->name('configurations.compliance.documents.update');
  Route::get('/configurations/compliance/documents/{bank_document}/delete', $controller_path . '\ConfigurationsController@deleteComplianceDocument')->name('configurations.compliance.documents.delete');
  Route::get('/configurations/base-rates', $controller_path . '\ConfigurationsController@baseRates')->name('configurations.base-rates');
  Route::get('/configurations/pending', $controller_path . '\ConfigurationsController@pending')->name('configrations.pending');
});

require __DIR__.'/auth.php';
