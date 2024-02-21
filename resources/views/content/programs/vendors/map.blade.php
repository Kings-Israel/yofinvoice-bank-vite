@extends('layouts/layoutMaster')

@section('title', 'Map Vendor To Program')

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
<script src="{{asset('assets/js/add-vendor-to-program.js')}}"></script>
<script src="{{asset('assets/js/form-wizard-validation.js')}}"></script>
<script>
  function updateResetFrequency() {
    let days = $('#reset-frequency').find(":selected").data('days');

    if (!days) {
      $('#reset-frequency-days').removeAttr('disabled');
    } else {
      $('#reset-frequency-days').attr('disabled', true);
      $('#reset-frequency-days').val(days);
    }
  }

  changeDiscountRates()

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
  <span class="fw-light">Map Vendor to Program - <span class="text-primary text-decoration-underline">{{ $program->name }}</span></span>
  <div class="d-flex">
    <button class="btn btn-label-secondary mx-2">Discard</button>
    <button class="btn btn-label-primary">Save Draft</button>
  </div>
</h4>
<!-- Default -->
<div class="row">
  <!-- Vertical Wizard -->
  <div class="col-12 mb-4">
    <div class="bs-stepper wizard-vertical vertical mt-2" id="vendor-details-wizard">
      <div class="bs-stepper-header">
        <div class="step" data-target="#vendor-details">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle"><i class="tf-icons ti ti-users"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Vendor Details</span>
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
        <form id="vendor-details-form" method="POST" action="{{ route('programs.vendors.map.store', ['bank' => $bank, 'program' => $program]) }}">
          @csrf
          <!-- Company Details -->
          <div id="vendor-details" class="content">
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="vendor">Vendor</label>
                <select class="form-select select2" id="vendor" name="vendor_id">
                  <option value="">Select</option>
                  @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="eligibility">Eligibility (%)</label>
                <input type="number" id="eligibility" class="form-control" name="eligibility" value="{{ $program->eligibility }}" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="invoice_margin">Invoice Margin (%)</label>
                <input type="number" id="invoice_margin" class="form-control" name="invoice_margin" disabled value="{{ 100 - $program->eligibility }}" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="sanctioned_limit">Sanctioned Limit</label>
                <input type="number" id="sanctioned_limit" class="form-control" name="sanctioned_limit" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="limit_approved_date">Limit Approval Date</label>
                <input class="form-control" type="date" id="html5-date-input" name="limit_approved_date" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="limit-expiry-date">Limit Expiry Date</label>
                <input class="form-control" type="date" id="html5-date-input" name="limit_expiry_date" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="limit_review_date">Limit Expiry Date</label>
                <input class="form-control" type="date" id="html5-date-input" name="limit_review_date" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="drawing_power">Drawing Power</label>
                <input type="number" id="drawing_power" class="form-control" name="drawing_power" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="request-autofinance">Request Auto Finance</label>
                <select class="form-select" id="request-autofinance" name="request_auto_finance">
                  <option value="">Select</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="auto-approve-finance">Auto Approve Finance</label>
                <select class="form-select" id="auto-approve-finance" name="auto_approve_finance">
                  <option value="">Select</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="schema-code">Schema Code</label>
                <input type="text" id="schema-code" class="form-control" name="schema_code" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="product-description">Product Description</label>
                <input type="text" id="product-description" class="form-control" name="product_description" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="vendor-code">Vendor Code</label>
                <input type="text" id="vendor-code" class="form-control" name="vendor_code" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="gst-no">GST No.</label>
                <input type="text" id="gst-no" class="form-control" name="gst_number" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="classification">Classificatioin</label>
                <select class="form-select" id="classification" name="classification">
                  <option value="">Select</option>
                  <option value="active">Secured</option>
                  <option value="inactive">Unsecured</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="tds">TDS</label>
                <select class="form-select" id="tds" name="tds">
                  <option value="">Select</option>
                  <option value="active">Not Applicable</option>
                  <option value="inactive">TDS Gross</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="status">Status</label>
                <select class="form-select" id="status" name="status">
                  <option value="">Select</option>
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                </select>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev" disabled> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
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
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="reset-frequency-days">Reset Frequency (Days)</label>
                <input type="number" id="reset-frequency-days" disabled class="form-control" name="days_frequency_days" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="business-strategy-spread">Business Strategy Spread (%)</label>
                <input type="number" id="business-strategy-spread" class="form-control" name="business_strategy_spread" readonly value="{{ $program->discountDetails->business_strategy_spread }}" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="credit-spread">Credit Spread (%)</label>
                <input type="number" id="credit-spread" class="form-control" name="credit_spread" readonly value="{{ $program->discountDetails->credit_spread }}" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="total-spread">Total Spread (%)</label>
                <input type="number" id="total-spread" class="form-control" name="total_spread" readonly value="{{ $program->discountDetails->total_spread }}" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="total-roi">Total ROI (%)</label>
                <input type="number" id="total-roi" class="form-control" name="total_roi" readonly value="{{ $program->discountDetails->total_roi }}" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="anchor-discount-bearing">Anchor Discount Bearing (%)</label>
                <input type="number" id="anchor-discount-bearing" class="form-control" name="anchor_discount_bearing" readonly value="{{ $program->discountDetails->anchor_discount_bearing }}" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="vendor-discount-bearing">Vendor Discount Bearing (%)</label>
                <input type="number" id="vendor-discount-bearing" class="form-control" name="vendor_discount_bearing" readonly value="{{ $program->discountDetails->vendor_discount_bearing }}" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="penal-discount-on-principle">Penal Discount on Principle (%)</label>
                <input type="number" id="penal-discount-on-principle" class="form-control" name="penal_discount_on_principle" readonly value="{{ $program->discountDetails->penal_discount_on_principle }}" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="grace-period">Grace Period (Days)</label>
                <input type="number" id="grace-period" class="form-control" name="grace_period" readonly value="{{ $program->discountDetails->grace_period }}" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="grace-period-discount">Grace Period Discount</label>
                <input class="form-control" type="number" id="grace-period-discount" name="grace_period_discount" readonly value="{{ $program->discountDetails->grace_period_discount }}" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="maturity-handling-on-holidays">Maturity Handling on Holidays</label>
                <select class="form-select" id="maturity-handling-on-holidays" name="maturity_handling_on_holidays">
                  <option value="No Effect" @if($program->discountDetails->maturity_handling_on_holidays == 'No Effect') selected @endif>No Effect</option>
                  <option value="Prepone to previous working day" @if($program->discountDetails->maturity_handling_on_holidays == 'Prepone to previous working day') selected @endif>Prepone to previous working day</option>
                  <option value="Postpone to next working day" @if($program->discountDetails->maturity_handling_on_holidays == 'Postpone to next working day') selected @endif>Postpone to next working day</option>
                </select>
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
                <input type="text" id="value" class="form-control" name="fee_values[]" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="ancor-discount-bearing">Anchor Discount Bearing (%)</label>
                <input type="number" id="ancor-discount-bearing" class="form-control" name="fee_anchor_bearing_discount[]" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="vendor-discount-bearing">Vendor Discount Bearing (%)</label>
                <input type="text" id="vendor-discount-bearing" class="form-control" name="fee_vendor_bearing_discount[]" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="taxes">Taxes</label>
                <div class="col-sm-6">
                  <label class="form-label" for="taxes">Taxes</label>
                  <select class="form-select" id="taxes" name="taxes[]">
                    @foreach ($taxes as $tax)
                      <option value="{{ $tax }}">{{ $tax }}</option>
                    @endforeach
                  </select>
                </div>
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
                <label class="form-label" for="vendor-email">Vendor Email</label>
                <input type="email" id="vendor-email" class="form-control" name="vendor_emails[]" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="vendor-mobile-no">Vendor Mobile No</label>
                <input type="tel" id="vendor-mobile-no" class="form-control" name="vendor_phone_numbers[]" />
              </div>
            </div>
            <button class="btn btn-sm btn-primary my-2">Add</button>
            <div class="row g-3">
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev" type="button"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next" type="button"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right"></i></button>
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
                <button class="btn btn-primary btn-submit" type="submit">Submit</button>
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
