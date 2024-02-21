@extends('layouts/layoutMaster')

@section('title', 'Program Details')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" /> --}}
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
{{-- <script src="{{asset('assets/vendor/libs/dropzone/dropzone.js')}}"></script> --}}
@endsection

@section('page-script')
@endsection

@section('content')
<h4 class="fw-bold py-2 mb-2 d-flex justify-content-between">
  <span class="fw-light">{{ $program->name }} Details</span>
</h4>
<!-- Default -->
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Program Type:</h6>
        <h5 class="px-2">{{ $program->programType->name }}</h5>
      </div>
      @if ($program->programCode)
        <div class="col-sm-6 text-align-center d-flex">
          <h6 class="mr-2">Program Code:</h6>
          <h5 class="px-2">{{ $program->programCode->name }}({{ $program->programCode->abbrev }})</h5>
        </div>
      @endif
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Code:</h6>
        <h5 class="px-2">{{ $program->code }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Eligibility:</h6>
        <h5 class="px-2">{{ $program->eligibility }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Invoice Margin:</h6>
        <h5 class="px-2">{{ $program->invoice_margin }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Program Limit:</h6>
        <h5 class="px-2">{{ number_format($program->program_limit) }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Maximum Limit Per Account:</h6>
        <h5 class="px-2">{{ $program->max_limit_per_account }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Collection Account:</h6>
        <h5 class="px-2">{{ $program->collection_account }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Request Auto Finance:</h6>
        <h5 class="px-2">{{ $program->request_auto_finance ? 'Yes' : 'No' }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Stale Invoice Period:</h6>
        <h5 class="px-2">{{ $program->stale_invoice_period }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Minimum Financing Days:</h6>
        <h5 class="px-2">{{ $program->min_financing_days }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Maximum Financing Days:</h6>
        <h5 class="px-2">{{ $program->max_financing_days }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Segment:</h6>
        <h5 class="px-2">{{ $program->segment }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Auto Debit Anchor for Financed Invoices:</h6>
        <h5 class="px-2">{{ $program->auto_debit_anchor_financed_invoices ? 'Yes' : 'No' }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Auto Debit Anchor For Non-financed Invoices:</h6>
        <h5 class="px-2">{{ $program->auto_debit_anchor_non_financed_invoices ? 'Yes' : 'No' }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Maximum Days for due date extension:</h6>
        <h5 class="px-2">{{ $program->max_days_due_date_extension }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Days Limit for Due date change:</h6>
        <h5 class="px-2">{{ $program->days_limit_for_due_date_change }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Default Payment Terms:</h6>
        <h5 class="px-2">{{ $program->default_payment_terms }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Anchor can change Payment Term:</h6>
        <h5 class="px-2">{{ $program->anchor_can_change_payment_term ? 'Yes' : 'No' }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Repayment Appropriation:</h6>
        <h5 class="px-2">{{ $program->repayment_appropriation }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Mandatory Invoice Attachment:</h6>
        <h5 class="px-2">{{ $program->mandatory_invoice_attachment ? 'Yes' : 'No' }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Partner:</h6>
        <h5 class="px-2">{{ $program->partner }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Recourse:</h6>
        <h5 class="px-2">{{ $program->recourse }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Due Date Calculated From:</h6>
        <h5 class="px-2">{{ $program->due_date_calculated_from }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">NOA:</h6>
        <h5 class="px-2">{{ $program->noa }}</h5>
      </div>
      <div class="col-sm-4 text-align-center d-flex">
        <h6 class="mr-2">Account Status:</h6>
        <h5 class="px-2">{{ $program->account_status }}</h5>
      </div>
    </div>
  </div>
</div>
<hr>
<div class="card">
  <div class="card-header">
    <div class="card-title"><h4>Anchor</h4></div>
    <div class="card-body p-0">
      <a href="{{ route('companies.show', ['bank' => $bank, 'company' => $program->anchor->id]) }}" class="card-text fw-bold text-decoration-underline">{{ $program->anchor->name }}</a>
    </div>
  </div>
</div>
@if (count($program->vendors) > 0)
  <br>
  <div class="card">
    <div class="card-header">
      <div class="card-title"><h4>Vendors</h4></div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr class="">
                <th>Company Name</th>
                <th>Company Type</th>
                <th>Limit</th>
                <th>Utilized Limit</th>
                <th>Pipeline Amount</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($program->vendors as $company)
                <tr class="text-nowrap">
                  <td class="text-primary text-decoration-underline">
                    <a href="{{ route('companies.show', ['bank' => $bank, 'company' => $company->id]) }}">
                      {{ $company->name }}
                    </a>
                  </td>
                  <td class="">{{ Str::title($company->organization_type) }}</td>
                  <td class="text-success">Ksh. {{ number_format($company->getProgramLimit($program)) }}</td>
                  <td class="text-success">Ksh. {{ number_format(0) }}</td>
                  <td class="text-success">Ksh. {{ number_format(0) }}</td>
                  <td class="d-flex">
                    <i class='ti ti-clock ti-sm text-primary'></i>
                    <i class='ti ti-circle-check ti-sm text-success'></i>
                    <i class='ti ti-arrows-cross ti-sm text-danger'></i>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endif
@endsection
