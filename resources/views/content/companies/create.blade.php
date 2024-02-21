@extends('layouts/layoutMaster')

@section('title', 'Add Company')

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
<script src="{{asset('assets/js/add-company-wizard.js')}}"></script>
<script src="{{asset('assets/js/form-wizard-validation.js')}}"></script>
{{-- <script src="{{asset('assets/js/forms-file-upload.js')}}"></script> --}}
@endsection

@section('content')
<h4 class="fw-bold py-2 mb-2 d-flex justify-content-between">
  <span class="fw-light">Add Company</span>
  <div class="d-flex">
    <button class="btn btn-label-secondary mx-2">Discard</button>
    <button class="btn btn-label-primary">Save Draft</button>
  </div>
</h4>
<!-- Default -->
<div class="row">
  <!-- Vertical Wizard -->
  <div class="col-12 mb-4">
    <div class="bs-stepper vertical mt-2" id="company-details-wizard">
      <div class="bs-stepper-header">
        <div class="step" data-target="#company-details">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle"><i class="tf-icons ti ti-users"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Company Details</span>
              <span class="bs-stepper-subtitle">Name/KRA PIN/Type</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#address-details">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle"><i class="tf-icons ti ti-location"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Company Address Details</span>
              <span class="bs-stepper-subtitle">Location Details</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#relationship-manager-details">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle"><i class="tf-icons ti ti-mood-smile"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title text-wrap">Relationship Manager Details</span>
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
        <form action="{{ route('companies.store', ['bank' => request()->route('bank')]) }}" method="POST" id="company-details-form" enctype="multipart/form-data">
          @csrf
          <!-- Company Details -->
          <div id="company-details" class="content">
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="company-name">Name</label>
                <input type="text" id="company-name" name="name" class="form-control" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="unique-identification-number">Unique Identification No.</label>
                <input type="text" id="unique-identification-number" name="unique_identification_number" class="form-control" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="branch-code">Branch Code</label>
                <input type="text" id="branch-code" class="form-control" name="branch_code" aria-describedby="password2-vertical" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="business-identification-number">Business Identification No.</label>
                <input type="text" id="business-identification-number" name="business_identification_number" class="form-control" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="organization-type">Organization Type</label>
                <select class="form-select" id="organization-type" name="organization_type">
                  <option value="Company">Company</option>
                  <option value="Proprietor">Proprietor</option>
                  <option value="Partnership">Partnership</option>
                  <option value="LLP">LLP</option>
                  <option value="Association of Persons">Association of Persons</option>
                  <option value="Cooperative Society">Cooperative Society</option>
                  <option value="Government">Government</option>
                  <option value="Hindu Undivided Family">Hindu Undivided Family</option>
                  <option value="Private Limited">Private Limited</option>
                  <option value="Public Limited">Public Limited</option>
                  <option value="Trust">Trust</option>
                  <option value="Others">Others</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="business-segment">Business Segment</label>
                <select class="form-select" id="business-segment" name="business_segment">
                  <option value="">Please Select</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="customer-type">Customer Type</label>
                <select class="form-select" id="customer-type" name="customer_type">
                  <option value="Bank Customer">Bank Customer</option>
                  <option value="Non-bank Customer">Non-bank Customer</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="kra-pin">KRA PIN</label>
                <input type="text" id="kra-pin" class="form-control" name="kra_pin" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="cust-ancode">CUST_ANCODE</label>
                <input type="text" id="cust-ancode" class="form-control" name="cust_ancode" />
              </div>
              <div class="col-sm-6">
                <label for="formFile" class="form-label">Company Logo</label>
                <input class="form-control" type="file" id="formFile" name="company_logo" accept=".jpg,.png">
              </div>
              {{-- <div class="col-12">
                <label class="form-label" for="company-logo">Company Logo</label>
                <div class="dropzone needsclick" id="dropzone-basic">
                  <div class="dz-message needsclick">
                    Drop files here or click to upload
                    <span class="note needsclick">(Compatible File include <strong>JPG, PNG</strong>)</span>
                  </div>
                  <div class="fallback">
                    <input name="file" type="file" />
                  </div>
                </div>
              </div> --}}
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev" disabled> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button type="button" class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right"></i></button>
              </div>
            </div>
          </div>
          <!-- Company Locatio Details -->
          <div id="address-details" class="content">
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="city">City</label>
                <select class="select2" id="city" name="city">
                  <option label=" "></option>
                  <option>Nairobi</option>
                  <option>Nakuru</option>
                  <option>Kisumu</option>
                  <option>Mombasa</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="zip-code">Pin/Zip/Postal Code</label>
                <input type="text" id="zip-code" class="form-control" name="postal_code" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="zip-code">Address</label>
                <input type="text" id="zip-code" class="form-control" name="address" />
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button type="button" class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button type="button" class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right"></i></button>
              </div>
            </div>
          </div>
          <!-- Relationship Manager -->
          <div id="relationship-manager-details" class="content">
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="relationship-manager-name">Relationship Manager Name</label>
                <input type="text" id="relationship-manager-name" class="form-control" name="relationship_manager_name" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="relationship-manager-email">Relationship Manager Email</label>
                <input type="email" id="relationship-manager-email" class="form-control" name="relationship_manager_email" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="relationship-manager-mobile">Relationship Manager Mobile</label>
                <input type="text" id="relationship-manager-mobile" class="form-control" name="relationship_manager_phone_number" />
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button type="button" class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button type="button" class="btn btn-primary btn-next">Add Company</button>
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
