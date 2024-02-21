@extends('layouts/layoutMaster')

@section('title', 'Base Rates')

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
  <span class="fw-light">Base Rate</span>
</h4>

<div class="card">
  <div class="card-body">
    <div class="p-3 d-flex justify-content-between">
      <div class="d-flex flex-wrap">
        <div class="">
          <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Base Rate Code" aria-describedby="defaultFormControlHelp" />
        </div>
        <div class="mx-2">
          <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Status" aria-describedby="defaultFormControlHelp" />
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
        <button type="button" class="btn btn-primary" style="margin-right: 10px;"><i class='ti ti-download ti-sm'></i></button>
        <a href="#">
          <button type="button" class="btn btn-primary text-nowrap" style="margin-right: 10px;">New Base Rate</button>
        </a>
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
            <th>User</th>
            <th>Rate (%)</th>
            <th>Approval Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <tr class="text-nowrap">
            <td>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
              </div>
            </td>
            <td>Base Rate 1</td>
            <td>8</td>
            <td><span class="badge bg-label-success">Approved</span></td>
            <td class="flex">
              <i class='ti ti-logout ti-sm mx-3'></i>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
            </td>
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
@endsection
