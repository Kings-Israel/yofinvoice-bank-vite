@extends('layouts/layoutMaster')

@section('title', 'Companies')

@section('vendor-style')

@endsection

@section('page-style')
<style>
  .table-responsive .dropdown,
  .table-responsive .btn-group,
  .table-responsive .btn-group-vertical {
      position: static;
  }
  .tab-content {
    padding: 0px !important;
  }
  .nav-tabs .nav-link {
    font-weight: 900;
    font-size: 14px;
  }
</style>
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
@endsection

@section('page-script')
<script>
$('#view-company-documents').on('click', function() {
  $('#companies').addClass('d-none')
  $('#company-documents').removeClass('d-none')
  $('#view-companies').removeClass('border', 'border-primary')
  $(this).addClass('border', 'border-primary')
})
</script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Companies</span>
</h4>

<div class="row match-height">
  <div class="col-lg-3 col-sm-12 mb-4">
    <div class="card h-100 border border-primary" id="view-companies">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">
          <h5 class="mb-0 me-2">{{ $companies->count() }}</h5>
          <small>Companies</small>
        </div>
        <div class="card-icon">
          <span class="badge bg-label-primary rounded-pill p-2">
            <i class='ti ti-list ti-sm'></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-12 mb-4">
    <div class="card h-100" id="view-company-documents">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">
          <h5 class="mb-0 me-2">Company Documents</h5>
        </div>
        <div class="card-icon">
          <span class="badge bg-label-warning rounded-pill p-2">
            <i class='ti ti-files ti-sm'></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-2 col-6 mb-4">
    <div class="card h-100">
      <div class="card-body text-center">
        <div class="badge rounded-pill p-2 bg-label-info mb-2"><i class="ti ti-upload ti-sm"></i></div>
        <h6 class="card-title mb-2">Upload Companies</h6>
      </div>
    </div>
  </div>
</div>

<div class="nav-align-top nav-tabs-shadow mb-4">
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <button type="button" class="nav-link active text-sm text-uppercase" role="tab" data-bs-toggle="tab" data-bs-target="#navs-active-companies" aria-controls="navs-active-companies" aria-selected="false">Companies</button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link text-uppercase" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pending-companies" aria-controls="navs-pending-companies" aria-selected="true">Pending Approval</button>
    </li>
  </ul>
  <div class="tab-content mt-4">
    <div class="tab-pane fade show active" id="navs-active-companies" role="tabpanel">
      <div id="companies">
        <companies-component bank="{!! request()->route('bank')->url !!}"></companies-component>
      </div>
    </div>
    <div class="tab-pane fade show" id="navs-pending-companies" role="tabpanel">
      <div id="pending-approval">
        <pending-approval-component bank="{!! request()->route('bank')->url !!}"></pending-approval-component>
      </div>
    </div>
  </div>
</div>
<br>
@endsection
