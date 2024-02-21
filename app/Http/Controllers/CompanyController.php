<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Jobs\SendMail;
use App\Models\Bank;
use App\Models\CompanyDocument;
use App\Models\Pipeline;
use App\Models\UploadedDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
  public function index(Bank $bank)
  {
    $companies = Company::where('bank_id', $bank->id)
                          ->get();

    $pending_companies = Pipeline::where('bank_id', $bank->id)
                                  ->whereHas('uploadedDocuments', function ($query) {
                                    $query->whereHas('companyDocuments', function ($query) {
                                      $query->where('status', 'pending')->orWhere('status', 'rejected');
                                    });
                                  })
                                  ->get();

    if (request()->wantsJson()) {
      return response()->json(['data' => ['companies' => $companies, 'pending_companies' => $pending_companies]], 200);
    }

    return view('content.companies.index', [
      'bank' => $bank,
      'companies' => $companies,
      'pending_companies' => $pending_companies
    ]);
  }

  public function create(Bank $bank)
  {
    return view('content.companies.create');
  }

  public function store(StoreCompanyRequest $request, Bank $bank)
  {
    $company = $bank->companies()->create($request->all());
    if ($request->hasFile('logo')) {
      $company->update([
        'logo' => pathinfo($request->logo->store('logo', 'company'), PATHINFO_BASENAME)
      ]);
    }

    toastr()->success('', 'Company created successfully');

    return redirect()->route('companies.index', ['bank' => $bank]);
  }

  public function show(Bank $bank, Company $company)
  {
    $company->load('documents', 'pipeline');

    return view('content.companies.show', compact('company', 'bank'));
  }

  public function showPending(Bank $bank, Pipeline $pipeline)
  {
    $pipeline->load('uploadedDocuments.companyDocuments');

    return view('content.companies.show-pending', compact('bank', 'pipeline'));
  }

  public function updateStatus(Bank $bank, Company $company, $status)
  {
    $company->update([
      'approval_status' => $status
    ]);

    toastr()->success('', 'Company status updated successfully');

    return back();
  }

  public function updateDocumentStatus(Bank $bank, Request $request)
  {
    $request->validate([
      'document_id' => ['required'],
      'status' => ['required'],
      'rejected_reason' => ['required_if:status,rejected'],
    ]);

    $document = CompanyDocument::find($request->document_id);

    $document->update([
      'status' => $request->status,
      'rejected_reason' => $request->has('rejected_reason') && !empty($request->rejected_reason) ? $request->rejected_reason : NULL
    ]);

    // TODO: Send email notification to company user

    toastr()->success('', 'Successfully updated document');

    return back();
  }

  public function requestDocuments(Bank $bank, Company $company, Request $request)
  {
    $request->validate([
      'documents' => ['required']
    ]);

    $requested_documents = explode(',', $request->documents);

    collect($requested_documents)->each(function ($doc) use ($company) {
      $company->requestedDocuments()->create([
        'name' => $doc
      ]);
    });

    // TODO: Send email notification to company user

    toastr()->success('', 'Request sent successfully');

    return back();
  }

  public function updatePendingDocumentStatus(Bank $bank, Request $request)
  {
    $request->validate([
      'document_id' => ['required'],
      'status' => ['required'],
      'rejected_reason' => ['required_if:status,rejected'],
    ]);

    $url = '';

    $document = CompanyDocument::with('uploadedDocument.pipeline')->find($request->document_id);

    $document->update([
      'status' => $request->status,
      'rejected_reason' => $request->has('rejected_reason') && !empty($request->rejected_reason) ? $request->rejected_reason : NULL
    ]);

    if ($document->status == 'rejected') {
      $uploadDocument = UploadedDocument::create([
        'slug' => Str::uuid(),
        'email' => $document->uploadedDocument->pipeline->email,
        'documents' => $document->uploadedDocument,
      ]);

      $url = env('APP_CRM_URL') . '/documents/' . $uploadDocument->slug;
    }

    // Send email notification to company user
    SendMail::dispatchAfterResponse($document->uploadedDocument->pipeline->email, 'DocumentUpdated', ['user_name' => $document->uploadedDocument->pipeline->name, 'document_id' => $document->id, 'status' => $document->status, 'url' => $url]);

    toastr()->success('', 'Successfully updated document');

    return back();
  }

  public function updatePipelineCompanyStatus(Bank $bank, Request $request)
  {
    $request->validate([
      'pipeline_id' => ['required'],
      'status' => ['required'],
    ]);

    $pipeline = Pipeline::find($request->pipeline_id);

    // Create company from pipeline
    $company = $bank->companies()->create([
      'name' => $pipeline->company,
      'business_segment' => $pipeline->department,
      'city' => $pipeline->region,
      'approval_status' => 'approved',
      'status' => 'active',
      'relationship_manager_name' => $pipeline->point_of_contact,
      'relationship_manager_email' => $pipeline->email,
      'relationship_manager_phone_number' => $pipeline->phone_number,
      'approval_status' => 'approved',
      'pipeline_id' => $pipeline->id,
    ]);

    $pipeline->uploadedDocuments->each(function ($document) use ($company) {
      $document->companyDocuments->each(function ($document) use ($company) {
        // Approve all documents
        $document->update(['status' => 'approved', 'rejected_reason' => NULL]);
        // Add to company documents
        CompanyDocument::create([
          'company_id' => $company->id,
          'name' => $document->original_name,
          'status' => 'approved',
        ]);
      });
    });

    SendMail::dispatchAfterResponse($company->relationship_manager_email, 'CompanyApproved', ['company' => $company, 'name' => $company->relationship_manager_name]);

    toastr()->success('', 'Company updated successfully');

    return redirect()->route('companies.index', ['bank' => $bank]);
  }
}
