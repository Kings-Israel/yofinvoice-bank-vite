@extends('layouts/layoutMaster')

@section('title', 'Payment Requests')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
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

</script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="fw-light">Payment Requests</span>
</h4>

<div class="row match-height">
  <div class="col-lg-3 col-sm-12 mb-4">
    <div class="card h-100 border border-primary">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">
          <h5 class="mb-0 me-2">378</h5>
          <small>Payment Requests</small>
        </div>
        <div class="card-icon">
          <span class="badge bg-label-primary rounded-pill p-2">
            <i class='ti ti-file ti-sm'></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-12 mb-4">
    <div class="card h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">
          <h5 class="mb-0 me-2">234</h5>
          <small>Payment Reports</small>
        </div>
        <div class="card-icon">
          <span class="badge bg-label-warning rounded-pill p-2">
            <i class='ti ti-file-text ti-sm'></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-12 mb-4">
    <div class="card h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">
          <h5 class="mb-0 me-2">34</h5>
          <small>CBS Transactions</small>
        </div>
        <div class="card-icon">
          <span class="badge bg-label-success rounded-pill p-2">
            <i class='ti ti-file-dollar ti-sm'></i>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="nav-align-top nav-tabs-shadow mb-4">
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <button type="button" class="nav-link active text-uppercase" role="tab" data-bs-toggle="tab" data-bs-target="#navs-all-invoices" aria-controls="navs-all-invoices" aria-selected="true">Payment Requests</button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link text-sm text-uppercase" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pending-invoices" aria-controls="navs-pending-invoices" aria-selected="false">Payment Reports</button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link text-sm text-uppercase" role="tab" data-bs-toggle="tab" data-bs-target="#navs-cbs-transactions" aria-controls="navs-cbs-transactions" aria-selected="false">CBS Transactions</button>
    </li>
  </ul>
  <div class="tab-content mt-4">
    <div class="tab-pane fade show active" id="navs-all-invoices" role="tabpanel">
      <!-- Invoice List Table -->
      <div class="p-3 d-flex justify-content-between">
        <div class="d-flex flex-wrap">
          <div class="">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="PR ID" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Debit From" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Company Name" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
          </div>
          <div class="mx-2">
            <select class="form-select" id="exampleFormControlSelect">
              <option value="">Status</option>
              <option value="1">Pending</option>
              <option value="2">Approved</option>
              <option value="3">Denied</option>
            </select>
          </div>
          <div class="mt-1">
            <select class="form-select" id="exampleFormControlSelect">
              <option value="">Sort By</option>
              <option value="1">Asc</option>
              <option value="2">Desc</option>
            </select>
          </div>
        </div>
        <div class="d-flex">
          <div style="margin-right: 10px;">
            <select class="form-select" id="exampleFormControlSelect1">
              <option value="1">10</option>
              <option value="2">20</option>
              <option value="3">50</option>
            </select>
          </div>
          <button type="button" class="btn btn-primary h-50" style="margin-right: 10px;"><i class='ti ti-download ti-sm'></i></button>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr class="">
              <th>PR ID</th>
              <th>Debit From.</th>
              <th>Credit To</th>
              <th>Company Name</th>
              <th>PO NO</th>
              <th>Invoice/Unique Ref No.</th>
              <th>Amount</th>
              <th>PI No</th>
              <th>Pay Date</th>
              <th>Paid Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <tr class="text-nowrap">
              <td><span class="fw-medium">7799</span></td>
              <td>88Re_int_rec</td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-primary text-decoration-underline">GameAnchor</td>
              <td class="text-primary text-decoration-underline"></td>
              <td>IN-29-01</td>
              <td class="text-success">Ksh 51000</td>
              <td class="text-primary text-decoration-underline">PI-233</td>
              <td>24 Nov 2023</td>
              <td>24 Nov 2023</td>
              <td><span class="badge bg-label-primary me-1">Pending</span></td>
            </tr>
            <tr class="text-nowrap">
              <td><span class="fw-medium">7799</span></td>
              <td>88Re_int_rec</td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-primary text-decoration-underline">GameAnchor</td>
              <td class="text-primary text-decoration-underline"></td>
              <td>IN-29-01</td>
              <td class="text-success">Ksh 51000</td>
              <td class="text-primary text-decoration-underline">PI-233</td>
              <td>24 Nov 2023</td>
              <td>24 Nov 2023</td>
              <td><span class="badge bg-label-success me-1">Created</span></td>
            </tr>
            <tr class="text-nowrap">
              <td><span class="fw-medium">7799</span></td>
              <td>88Re_int_rec</td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-primary text-decoration-underline">GameAnchor</td>
              <td class="text-primary text-decoration-underline"></td>
              <td>IN-29-01</td>
              <td class="text-success">Ksh 51000</td>
              <td class="text-primary text-decoration-underline">PI-233</td>
              <td>24 Nov 2023</td>
              <td>24 Nov 2023</td>
              <td><span class="badge bg-label-success me-1">Created</span></td>
            </tr>
            <tr class="text-nowrap">
              <td><span class="fw-medium">7799</span></td>
              <td>88Re_int_rec</td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-primary text-decoration-underline">GameAnchor</td>
              <td class="text-primary text-decoration-underline"></td>
              <td>IN-29-01</td>
              <td class="text-success">Ksh 51000</td>
              <td class="text-primary text-decoration-underline">PI-233</td>
              <td>24 Nov 2023</td>
              <td>24 Nov 2023</td>
              <td><span class="badge bg-label-primary me-1">Pending</span></td>
            </tr>
            <tr class="text-nowrap">
              <td><span class="fw-medium">7799</span></td>
              <td>88Re_int_rec</td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-primary text-decoration-underline">GameAnchor</td>
              <td class="text-primary text-decoration-underline"></td>
              <td>IN-29-01</td>
              <td class="text-success">Ksh 51000</td>
              <td class="text-primary text-decoration-underline">PI-233</td>
              <td>24 Nov 2023</td>
              <td>24 Nov 2023</td>
              <td><span class="badge bg-label-success me-1">Created</span></td>
            </tr>
          </tbody>
        </table>
      </div>
      <nav aria-label="Page navigation" class="mt-2">
        <ul class="pagination justify-content-end">
          <li class="page-item prev">
            <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevrons-left ti-xs"></i></a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">1</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">2</a>
          </li>
          <li class="page-item active">
            <a class="page-link" href="javascript:void(0);">3</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">4</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">5</a>
          </li>
          <li class="page-item next">
            <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevrons-right ti-xs"></i></a>
          </li>
        </ul>
      </nav>
    </div>
    <div class="tab-pane fade show" id="navs-pending-invoices" role="tabpanel">
      <div class="p-3 d-flex justify-content-between">
        <div class="d-flex flex-wrap">
          <div class="">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="PR ID" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Debit From" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Company Name" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
          </div>
          <div class="mx-2">
            <select class="form-select" id="exampleFormControlSelect">
              <option value="">Status</option>
              <option value="1">Pending</option>
              <option value="2">Approved</option>
              <option value="3">Denied</option>
            </select>
          </div>
          <div class="mt-1">
            <select class="form-select" id="exampleFormControlSelect">
              <option value="">Sort By</option>
              <option value="1">Asc</option>
              <option value="2">Desc</option>
            </select>
          </div>
        </div>
        <div class="d-flex">
          <div style="margin-right: 10px;">
            <select class="form-select" id="exampleFormControlSelect1">
              <option value="1">10</option>
              <option value="2">20</option>
              <option value="3">50</option>
            </select>
          </div>
          <button type="button" class="btn btn-primary h-50" style="margin-right: 10px;"><i class='ti ti-download ti-sm'></i></button>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr class="">
              <th>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
              </th>
              <th>CBS Transaction ID</th>
              <th>Pay Date</th>
              <th>Payment Date</th>
              <th>Transaction Type</th>
              <th>Vendor</th>
              <th>Debit From</th>
              <th>Credit To</th>
              <th>Amount</th>
              <th>Transaction Ref</th>
              <th>Invoice No</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <tr class="text-nowrap">
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                </div>
              </td>
              <td><span class="fw-medium">003478</span></td>
              <td>24 Nov 2023</td>
              <td>24 Nov 2023</td>
              <td>Loan Disbursement</td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-primary text-decoration-underline">GameAnchor</td>
              <td class="">345767</td>
              <td class="text-success">Ksh 51000</td>
              <td>36543quy32</td>
              <td class="text-primary text-decoration-underline">INV_2233</td>
            </tr>
            <tr class="text-nowrap">
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                </div>
              </td>
              <td><span class="fw-medium">003478</span></td>
              <td>24 Nov 2023</td>
              <td>24 Nov 2023</td>
              <td>Loan Disbursement</td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-primary text-decoration-underline">GameAnchor</td>
              <td class="">345767</td>
              <td class="text-success">Ksh 51000</td>
              <td>36543quy32</td>
              <td class="text-primary text-decoration-underline">INV_2233</td>
            </tr>
            <tr class="text-nowrap">
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                </div>
              </td>
              <td><span class="fw-medium">003478</span></td>
              <td>24 Nov 2023</td>
              <td>24 Nov 2023</td>
              <td>Loan Disbursement</td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-primary text-decoration-underline">GameAnchor</td>
              <td class="">345767</td>
              <td class="text-success">Ksh 51000</td>
              <td>36543quy32</td>
              <td class="text-primary text-decoration-underline">INV_2233</td>
            </tr>
            <tr class="text-nowrap">
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                </div>
              </td>
              <td><span class="fw-medium">003478</span></td>
              <td>24 Nov 2023</td>
              <td>24 Nov 2023</td>
              <td>Loan Disbursement</td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-primary text-decoration-underline">GameAnchor</td>
              <td class="">345767</td>
              <td class="text-success">Ksh 51000</td>
              <td>36543quy32</td>
              <td class="text-primary text-decoration-underline">INV_2233</td>
            </tr>
          </tbody>
        </table>
      </div>
      <nav aria-label="Page navigation" class="mt-2">
        <ul class="pagination justify-content-end">
          <li class="page-item prev">
            <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevrons-left ti-xs"></i></a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">1</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">2</a>
          </li>
          <li class="page-item active">
            <a class="page-link" href="javascript:void(0);">3</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">4</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">5</a>
          </li>
          <li class="page-item next">
            <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevrons-right ti-xs"></i></a>
          </li>
        </ul>
      </nav>
    </div>
    <div class="tab-pane fade show" id="navs-cbs-transactions" role="tabpanel">
      <div class="p-3 d-flex justify-content-between">
        <div class="d-flex flex-wrap">
          <div class="mb-2">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="CBS/PR ID" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Debit From/Credit To" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Invoice/Unique Ref" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
          </div>
          <div class="">
            <select class="form-select" id="exampleFormControlSelect">
              <option value="">Status</option>
              <option value="1">Pending</option>
              <option value="2">Approved</option>
              <option value="3">Denied</option>
            </select>
          </div>
          <div class="mx-2">
            <select class="form-select" id="exampleFormControlSelect">
              <option value="">Product Type</option>
              <option value="1">Vendor Financing</option>
              <option value="2">Factoring</option>
              <option value="3">Dealer Financing</option>
            </select>
          </div>
        </div>
        <div class="d-flex">
          <div style="margin-right: 10px;">
            <select class="form-select" id="exampleFormControlSelect1">
              <option value="1">10</option>
              <option value="2">20</option>
              <option value="3">50</option>
            </select>
          </div>
          <button type="button" class="btn btn-primary h-50" style="margin-right: 10px;"><i class='ti ti-download ti-sm'></i></button>
          <button type="button" class="btn btn-primary h-50 text-nowrap" style="margin-right: 10px;">Upload Transactions</button>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr class="">
              <th>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
              </th>
              <th>CBS ID</th>
              <th>PR ID</th>
              <th>Debit From</th>
              <th>Credit To</th>
              <th>Amount</th>
              <th>invoice / Unique Ref No</th>
              <th>Pay Date</th>
              <th>Transaction Date</th>
              <th>Product Type</th>
              <th>Payment Service</th>
              <th>Invoice No</th>
              <th>Status</th>
              <th>View</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <tr class="text-nowrap">
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                </div>
              </td>
              <td><span class="fw-medium">7548</span></td>
              <td><span class="fw-medium">2342</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-primary text-decoration-underline">GameAnchor</td>
              <td class="text-success">Ksh 51000</td>
              <td class="text-primary text-decoration-underline">INV_2233</td>
              <td>24 Nov 2023</td>
              <td>24 Nov 2023</td>
              <td>Vendor Financing</td>
              <td class="">Fund Transfer</td>
              <td><span class="badge bg-label-success me-1">Successful</span></td>
              <td><i class='ti ti-file-eye ti-sm'></i></td>
            </tr>
          </tbody>
        </table>
      </div>
      <nav aria-label="Page navigation" class="mt-2">
        <ul class="pagination justify-content-end">
          <li class="page-item prev">
            <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevrons-left ti-xs"></i></a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">1</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">2</a>
          </li>
          <li class="page-item active">
            <a class="page-link" href="javascript:void(0);">3</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">4</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">5</a>
          </li>
          <li class="page-item next">
            <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevrons-right ti-xs"></i></a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>
@endsection
