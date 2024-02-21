<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankDocument;
use Illuminate\Http\Request;

class ConfigurationsController extends Controller
{
  public function index(Bank $bank)
  {
    $documents = $bank->requiredDocuments;

    return view('content.bank.configurations.index', ['bank' => $bank, 'documents' => $documents]);
  }

  public function baseRates(Bank $bank)
  {
    return view('content.bank.configurations.base-rate');
  }

  public function pending(Bank $bank)
  {
    return view('content.bank.configurations.pending');
  }

  public function updateComplianceDocuments(Request $request, Bank $bank)
  {
    $request->validate([
      'name' => ['required', 'array', 'min:1']
    ]);

    $bank->requiredDocuments()->delete();

    foreach ($request->name as $key => $value) {
      $bank->requiredDocuments()->create([
        'name' => $value
      ]);
    }

    toastr()->success('', 'Compliance Documents updated successfully');

    return back();
  }

  public function addComplianceDocument(Request $request, Bank $bank)
  {
    $request->validate([
      'name' => ['required']
    ]);

    $bank->requiredDocuments()->create([
      'name' => $request->name
    ]);

    toastr()->success('', 'Added Compliance document successfully');

    return back();
  }

  public function deleteComplianceDocument(Bank $bank, BankDocument $bank_document)
  {
    $bank_document->delete();

    toastr()->success('', 'Deleted successfully');

    return back();
  }
}
