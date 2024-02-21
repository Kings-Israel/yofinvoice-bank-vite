@extends('layouts/layoutMaster')

@section('title', 'Pending Configurations')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/swiper/swiper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-advance.css')}}">
<style>
  .table-responsive .dropdown,
  .table-responsive .btn-group,
  .table-responsive .btn-group-vertical {
      position: static;
  }
</style>
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/swiper/swiper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/forms-editors.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="fw-light">Proposed Configurations Changes (2)</span>
</h4>

<div class="card">
  <div class="card-body">
    <div class="table-responsive pb-2 border-top border-bottom border-secondary">
      <table class="table">
        <thead>
          <tr>
            <th>Particulars</th>
            <th>Date Created</th>
            <th>Proposed By</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <tr class="text-nowrap">
            <td>
              <div class="">
                <p>Bank Base Rate has been changed from yes to no</p>
              </div>
            </td>
            <td>
              <div class="">
                23 Nov 2023
              </div>
            </td>
            <td>
              <div class="">
                CRM User
              </div>
            </td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-boundary="viewport" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);">Approve</a>
                  <a class="dropdown-item" href="javascript:void(0);">Reject</a>
                </div>
              </div>
            </td>
          </tr>
          <tr class="text-nowrap">
            <td>
              <div class="">
                <p>Bank Base Rate has been changed from yes to no</p>
              </div>
            </td>
            <td>
              <div class="">
                23 Nov 2023
              </div>
            </td>
            <td>
              <div class="">
                CRM User
              </div>
            </td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-boundary="viewport" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);">Approve</a>
                  <a class="dropdown-item" href="javascript:void(0);">Reject</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer">
    <div class="d-flex justify-content-end my-2 mx-3">
      <button class="btn btn-secondary">
        Cancel
      </button>
      <button class="btn btn-primary" style="margin-left: 10px;">
        Submit
      </button>
    </div>
  </div>
</div>
@endsection
