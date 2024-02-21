@extends('layouts/layoutMaster')

@section('title', 'Add Program')

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
<script src="{{asset('assets/js/add-program-wizard.js')}}"></script>
<script src="{{asset('assets/js/form-wizard-validation.js')}}"></script>
<script>
  function getProgramCodes() {
    let codes = $('#product-type').find(':selected').data('codes')

    let codeOptions = document.getElementById('product-code')
    while (codeOptions.options.length) {
      codeOptions.remove(0);
    }
    if (codes) {
      var i;
      for (i = 0; i < codes.length; i++) {
        var subcounty = new Option(codes[i].name+' - '+codes[i].abbrev, codes[i].id);
        codeOptions.options.add(subcounty);
      }
    }
  }

  function updateResetFrequency() {
    let days = $('#reset-frequency').find(":selected").data('days');

    if (!days) {
      $('#reset-frequency-days').removeAttr('readonly');
    } else {
      $('#reset-frequency-days').attr('readonly', true);
      $('#reset-frequency-days').val(days);
    }
  }

  function changeDiscountRates() {
    // Benchmark rate
    let rate = $('#benchmark-title').find(':selected').data('rate')

    let current_benchmark_rate = $('#current-brnchmark-rate').val(rate);
    if (rate) {
      current_benchmark_rate.val(rate)
    }

    // Business Strategy Spread
    let business_strategy_spread = $('#business-strategy-spread');
    // Credit Spread
    let credit_spread = $('#credit-spread');
    // Total ROI
    let total_roi = $('#total-roi');
    // Total Spread
    let total_spread = $('#total-spread');
    // Anchor Discount Bearing
    let anchor_discount_bearing = $('#anchor-discount-bearing');
    // Vendor Discount bearing
    let vendor_discount_bearing = $('#vendor-discount-bearing');

    if (Number(business_strategy_spread.val()) > 0 && Number(credit_spread.val()) > 0) {
      total_spread.val(Number(business_strategy_spread.val()) + Number(credit_spread.val()));
    }

    if (Number(total_spread.val()) > 0 && Number(current_benchmark_rate.val()) > 0) {
      total_roi.val(Number(total_spread.val()) + Number(current_benchmark_rate.val()))
    }

    if (Number(total_roi.val()) > 0 && Number(anchor_discount_bearing.val()) > 0) {
      vendor_discount_bearing.val(Number(total_roi.val())- Number(anchor_discount_bearing.val()))
    }
  }
</script>
@endsection

@section('content')
<h4 class="fw-bold py-2 mb-2 d-flex justify-content-between">
  <span class="fw-light">Add Program</span>
  <div class="d-flex">
    <button class="btn btn-label-secondary mx-2">Discard</button>
    <button class="btn btn-label-primary">Save Draft</button>
  </div>
</h4>
<!-- Default -->
<div class="row">
  <!-- Vertical Wizard -->
  <div class="col-12 mb-4">
    <div class="bs-stepper wizard-vertical vertical mt-2" id="program-details-wizard">
      <div class="bs-stepper-header">
        <div class="step" data-target="#program-details">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle"><i class="tf-icons ti ti-users"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Program Details</span>
              <span class="bs-stepper-subtitle">Name/Anchor/Type</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#discount-details">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle"><i class="tf-icons ti ti-location"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Discount & Fee Details</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#comm-details">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle"><i class="tf-icons ti ti-mood-smile"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title text-wrap">Email & Mobile Details</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#bank-details">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle"><i class="tf-icons ti ti-mood-smile"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title text-wrap">Bank Details</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#drafts">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle"><i class="tf-icons ti ti-circle-check"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Drafts</span>
              <span class="bs-stepper-subtitle">Saved Drafts</span>
            </span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content">
        <form id="program-details-form" method="POST" action="{{ route('programs.store', ['bank' => $bank]) }}">
          @csrf
          <!-- Company Details -->
          <div id="program-details" class="content">
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="product-type">Product Type</label>
                <select class="form-select" id="product-type" name="program_type_id" onchange="getProgramCodes()">
                  <option value="">Select</option>
                  @foreach ($program_types as $program_type)
                    <option value="{{ $program_type->id }}" data-codes="{{ $program_type->programCodes }}">{{ $program_type->name }}</option>
                  @endforeach
                </select>
                <x-input-error :messages="$errors->get('product_type_id')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="product-code">Product Code</label>
                <select class="form-select" id="product-code" name="program_code_id">
                  <option value="">Select</option>
                </select>
                <x-input-error :messages="$errors->get('program_code_id')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="anchor">Anchor</label>
                <select class="form-select select2" id="anchor" name="anchor_id">
                  <option value="">Select</option>
                  @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                  @endforeach
                </select>
                <x-input-error :messages="$errors->get('anchor_id')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="product-name">Name</label>
                <input type="text" id="product-name" class="form-control" name="name" />
                <x-input-error :messages="$errors->get('name')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="eligibility">Eligibility (%)</label>
                <input type="number" id="eligibility" class="form-control" name="eligibility" />
                <x-input-error :messages="$errors->get('eligiblity')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="program-limit">Total Program Limit</label>
                <input type="number" id="program-limit" class="form-control" name="program_limit" />
                <x-input-error :messages="$errors->get('program_limit')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="approval-date">Program Approval Date</label>
                <input class="form-control" type="date" id="html5-date-input" name="approved_date" />
                <x-input-error :messages="$errors->get('approved_date')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="limit-expiry-date">Limit Expiry Date</label>
                <input class="form-control" type="date" id="html5-date-input" name="limit_expiry_date" />
                <x-input-error :messages="$errors->get('limit_expiry_date')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="limit-per-account">Maximum Limit Per Account</label>
                <input type="number" id="limit-per-account" class="form-control" name="max_limit_per_account" />
                <x-input-error :messages="$errors->get('max_limit_per_account')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="request-autofinance">Request Auto Finance</label>
                <select class="form-select" id="request-autofinance" name="request_auto_finance">
                  <option value="">Select</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
                <x-input-error :messages="$errors->get('request_auto_finance')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="min-financing-days">Minimum Financing Days</label>
                <input type="number" id="min-financing-days" class="form-control" name="min_financing_days" />
                <x-input-error :messages="$errors->get('min_financing_days')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="max-financing-days">Maximum Financing Days</label>
                <input type="number" id="max-financing-days" class="form-control" name="max_financing_days" />
                <x-input-error :messages="$errors->get('max_financing_days')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="auto-debit-anchor">Auto Debit Anchor for Financed Invoices</label>
                <select class="form-select" id="auto-debit-anchor" name="auto_debit_anchor_financed_invoices">
                  <option value="">Select</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
                <x-input-error :messages="$errors->get('auto_debit_anchor_financed_invoices')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="auto-debit-anchor-for-non-financed">Auto Debit Anchor for Non-Financed Invoices</label>
                <select class="form-select" id="auto-debit-anchor-for-non-financed" name="auto_debit_anchor_non_financed_invoices">
                  <option value="">Select</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
                <x-input-error :messages="$errors->get('auto_debit_anchor_non_financed_invoices')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="allow-anchor-to-change-due-date">Allow Anchor to change due date</label>
                <select class="form-select" id="allow-anchor-to-change-due-date" name="anchor_can_change_due_date">
                  <option value="">Select</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
                <x-input-error :messages="$errors->get('anchor_can_change_due_date')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="max-days-for-invoice-date-extension">Maximum No. of days for Invoice Due Date Extensions</label>
                <input type="number" id="max-days-for-invoice-date-extension" class="form-control" name="max_days_due_date_extension" />
                <x-input-error :messages="$errors->get('max_days_due_date_extension')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="number-of-days-for-due-date-change">No. of Days Limit for changing Invoice Due Date</label>
                <input type="number" id="number-of-days-for-due-date-change" class="form-control" name="days_limit_for_due_date_change" />
                <x-input-error :messages="$errors->get('days_limit_for_due_date_change')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="default-payment-terms">Default Payment Terms(Days)</label>
                <input type="number" id="default-payment-terms" class="form-control" name="default_payment_terms" />
                <x-input-error :messages="$errors->get('default_payment_terms')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="allow-anchor-to-change-payment-terms">Allow Anchor to change Payment Terms</label>
                <select class="form-select" id="allow-anchor-to-change-payment-terms" name="anchor_can_change_payment_term">
                  <option value="">Select</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
                <x-input-error :messages="$errors->get('anchor_can_change_payment_term')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="recourse">Recourse</label>
                <select class="form-select" id="recourse" name="recourse">
                  <option value="">Select</option>
                  <option value="With Recourse">With Recourse</option>
                  <option value="Without Recourse">Without Recourse</option>
                </select>
                <x-input-error :messages="$errors->get('recourse')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="mandatory_invoice_attachment">Mandatory for Invoice Attachment</label>
                <select class="form-select" id="mandatory_invoice_attachment" name="mandatory_invoice_attachment">
                  <option value="">Select</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
                <x-input-error :messages="$errors->get('mandatory_invoice_attachment')" />
              </div>
              <div class="col-sm-6">
                <label for="formFile" class="form-label">Company Board Resolution Attachment</label>
                <input class="form-control" type="file" id="formFile" name="board_resolution_attachment">
                <x-input-error :messages="$errors->get('board_resolution_attachment')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="account-status">Status</label>
                <select class="form-select" id="account-status" name="account_status">
                  <option value="">Select</option>
                  <option value="active">Active</option>
                  <option value="suspended">Suspended</option>
                </select>
                <x-input-error :messages="$errors->get('account_status')" />
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev" readonly> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next" type="button"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right"></i></button>
              </div>
            </div>
          </div>
          <!-- Discount Details -->
          <div id="discount-details" class="content">
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="benchmark-title">Benchmark Title(Maturity)</label>
                <select class="form-select" id="benchmark-title" name="benchmark_title" onchange="changeDiscountRates()">
                  <option value="">Select Base Rate</option>
                  @foreach ($benchmark_rates as $key => $benchmark_rate)
                    <option value="{{ $key }}" data-rate="{{ $benchmark_rate }}">{{ $key }}</option>
                  @endforeach
                </select>
                <x-input-error :messages="$errors->get('benchmark_title')" />
              </div>
              <div class="col-sm-6">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="current-brnchmark-rate">Current Base Rate</label>
                  <span class="text-primary">Set As Per Current Master</span>
                </div>
                <input type="number" readonly id="current-brnchmark-rate" class="form-control" readonly name="benchmark_rate" />
                <x-input-error :messages="$errors->get('benchmark_rate')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="reset-frequency">Frequency Of Reset</label>
                <select class="form-select" id="reset-frequency" name="reset_frequency" onchange="updateResetFrequency()">
                  @foreach ($reset_frequencies as $key => $reset_frequency)  
                    <option value="{{ $key }}" data-days="{{ $reset_frequency }}">{{ $key }}</option>
                  @endforeach
                  <option value="custom">Custom</option>
                </select>
                <x-input-error :messages="$errors->get('reset_frequency')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="reset-frequency-days">Reset Frequency (Days)</label>
                <input type="number" id="reset-frequency-days" readonly class="form-control" name="days_frequency_days" />
                <x-input-error :messages="$errors->get('days_frequency_days')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="business-strategy-spread">Business Strategy Spread (%)</label>
                <input type="number" id="business-strategy-spread" class="form-control" min="0" max="100" name="business_strategy_spread" oninput="changeDiscountRates()" />
                <x-input-error :messages="$errors->get('business_strategy_spread')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="credit-spread">Credit Spread (%)</label>
                <input type="number" id="credit-spread" class="form-control" name="credit_spread" min="0" max="100" oninput="changeDiscountRates()" />
                <x-input-error :messages="$errors->get('credit_spread')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="total-spread">Total Spread (%)</label>
                <input type="number" id="total-spread" readonly class="form-control" min="0" max="100" name="total_spread" />
                <x-input-error :messages="$errors->get('total_spread')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="total-roi">Total ROI (%)</label>
                <input type="number" id="total-roi" readonly class="form-control" min="0" max="100" name="total_roi" />
                <x-input-error :messages="$errors->get('total_roi')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="anchor-discount-bearing">Anchor Discount Bearing (%)</label>
                <input type="number" id="anchor-discount-bearing" class="form-control" min="0" max="100" name="anchor_discount_bearing" oninput="changeDiscountRates()" />
                <x-input-error :messages="$errors->get('anchor_discount_bearing')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="vendor-discount-bearing">Vendor Discount Bearing (%)</label>
                <input type="number" id="vendor-discount-bearing" class="form-control" min="0" max="100" readonly name="vendor_discount_bearing" />
                <x-input-error :messages="$errors->get('vendor_discount_bearing')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="discount-type">Discount Type</label>
                <select class="form-select" id="discount-type" name="discount_type">
                  <option value="">Select Discount Type</option>
                  <option value="Front Ended">Front Ended</option>
                  <option value="Rear Ended">Rear Ended</option>
                </select>
                <x-input-error :messages="$errors->get('discount_type')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="penal-discount-on-principle">Penal Discount on Principle (%)</label>
                <input type="number" id="penal-discount-on-principle" class="form-control" min="0" max="100" name="penal_discount_on_principle" />
                <x-input-error :messages="$errors->get('penal_discount_on_principle')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="anchor-fee-recovery">Anchor Fee Recovery</label>
                <input type="text" id="anchor-fee-recovery" class="form-control" name="anchor_fee_recovery" />
                <x-input-error :messages="$errors->get('anchor_fee_recovery')" />
              </div>
              {{-- <div class="col-sm-6">
                <label class="form-label" for="penal-discount-on-discount">Penal Discount on Discount (%)</label>
                <input type="number" id="penal-discount-on-discount" class="form-control" />
              </div> --}}
              <div class="col-sm-6">
                <label class="form-label" for="grace-period">Grace Period (Days)</label>
                <input type="number" id="grace-period" class="form-control" min="0" name="grace_period" />
                <x-input-error :messages="$errors->get('grace_period')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="grace-period-discount">Grace Period Discount</label>
                <input class="form-control" type="number" id="grace-period-discount" min="0" max="100" name="grace_period_discount" />
                <x-input-error :messages="$errors->get('grace_period_discount')" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="maturity-handling-on-holidays">Maturity Handling on Holidays</label>
                <select class="form-select" id="maturity-handling-on-holidays" name="maturity_handling_on_holidays">
                  <option value="No Effect">No Effect</option>
                  <option value="Prepone to previous working day">Prepone to previous working day</option>
                  <option value="Postpone to next working day">Postpone to next working day</option>
                </select>
                <x-input-error :messages="$errors->get('maturity_handling_on_holidays')" />
              </div>
              <div class="col-sm-6">
              </div>
              <hr>
              <div class="col-sm-6">
                <label class="form-label" for="fee-name">Fee Name</label>
                <input type="text" id="fee-name" class="form-control" name="fee_names[]" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="credit-emi-from">Type</label>
                <select class="form-select" id="credit-emi-from" name="fee_types[]">
                  <option value="percentage">Percentage</option>
                  <option value="amount">Amount</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="value">Value</label>
                <input type="number" id="value" class="form-control" name="fee_values[]" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="ancor-discount-bearing">Anchor Discount Bearing (%)</label>
                <input type="number" id="ancor-discount-bearing" class="form-control" name="fee_anchor_bearing_discount[]" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="vendor-discount-bearing">Vendor Discount Bearing (%)</label>
                <input type="number" id="vendor-discount-bearing" class="form-control" name="fee_vendor_bearing_discount[]" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="taxes">Taxes</label>
                <select class="form-select" id="taxes" name="taxes[]">
                  @foreach ($taxes as $tax)
                    <option value="{{ $tax }}">{{ $tax }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev" type="button"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next" type="button"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right"></i></button>
              </div>
            </div>
          </div>
          <!-- Email Mobile Details -->
          <div id="comm-details" class="content">
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="anchor-email">Anchor Email ID</label>
                <input type="email" id="anchor-email" class="form-control" name="anchor_emails[]" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="anchor-mobile-no">Anchor Mobile No</label>
                <input type="tel" id="anchor-mobile-no" class="form-control" name="anchor_phone_numbers[]" />
              </div>
            </div>
            <button class="btn btn-sm btn-primary my-2">Add</button>
            <hr>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="bank-user-name">Bank User Name</label>
                <select class="form-select" id="bank-user-name" name="bank_user_nammes[]">
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="bank-user-email">Bank Email</label>
                <input type="email" id="bank-user-email" class="form-control" readonly name="bank_user_emails[]" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="bank-user-phone-number">Bank User Mobile No.</label>
                <input type="text" id="bank-user-phone-number" class="form-control" name="bank_user_phone_numbers[]" />
              </div>
            </div>
            <button class="btn btn-sm btn-primary my-2">Add</button>
            <div class="row g-3">
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev" type="button"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next" type="button">Next</button>
              </div>
            </div>
          </div>
          <!-- Bank Details -->
          <div id="bank-details" class="content">
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="name-as-per-bank">Name as per Bank</label>
                <input type="text" id="name-as-per-bank" class="form-control" name="bank_names_as_per_banks[]" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="account-number">Account Number</label>
                <input type="text" id="account-number" class="form-control" name="account_numbers[]" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="bank-name">Bank Name</label>
                <select class="form-select" id="bank-name" name="bank_names[]">
                  <option value="KCB">KCB</option>
                  <option value="Absa">Absa</option>
                  <option value="Equity">Equity</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="bank-branch">Branch</label>
                <input type="text" id="bank-branch" class="form-control" name="branches[]" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="swift-code">SWIFT Code</label>
                <input type="text" id="swift-code" class="form-control" name="swift_codes[]" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="account-type">Account Type</label>
                <input type="text" id="account-type" class="form-control" name="account_types[]" />
              </div>
            </div>
            <button class="btn btn-sm btn-primary my-2">Add new bank details</button>
            <div class="row g-3">
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev" type="button"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-submit">Add Program</button>
              </div>
            </div>
          </div>
          <!-- Saved Drafts -->
          <div id="drafts" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Drafts</h6>
              <small>Your saved drafts.</small>
            </div>
            <div class="row g-3">

            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /Vertical Wizard -->
</div>
@endsection
