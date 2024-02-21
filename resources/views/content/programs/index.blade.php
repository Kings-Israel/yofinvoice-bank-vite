@extends('layouts/layoutMaster')

@section('title', 'Programs')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
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

@section('page-script')
<script>
  function NumFormatter (data) {
    return parseFloat(data).toLocaleString(undefined, {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });
  };
  let fv, offCanvasEl;

  // datatable (jquery)
  $(function () {
    var dt_pending_programs = $('.dt-pending-programs'),
      dt_pending;

    if (dt_pending_programs.length) {
      dt_pending = dt_pending_programs.DataTable({
        ajax: "{{ route('programs.index', ['bank' => $bank, 'status' => 'pending']) }}",
        columns: [
          // { data: 'id' },
          { data: 'code' },
          { data: 'anchor' },
          { data: 'date_added' },
          { data: 'limit' },
          { data: 'status' },
          { data: '' }
        ],
        columnDefs: [
          // {
          //   // For Checkboxes
          //   targets: 0,
          //   orderable: false,
          //   searchable: false,
          //   responsivePriority: 3,
          //   checkboxes: true,
          //   render: function () {
          //     return '<input type="checkbox" class="dt-checkboxes form-check-input">';
          //   },
          //   checkboxes: {
          //     selectAllRender: '<input type="checkbox" class="form-check-input">'
          //   }
          // },
          {
            // Code
            targets: 0,
            responsivePriority: 4,
            render: function (data, type, full, meta) {
              var id = full.id;
              var url = "{{ route('programs.show', ['bank' => $bank, 'program' => ':id']) }}"
              url = url.replace(':id', id)
              return '<a href="'+url+'" class="text-decoration-underline text-primary">'+data+'</a>';
            }
          },
          {
            // Anchor
            targets: 1,
            responsivePriority: 4,
            render: function (data, type, full, meta) {
              var id = full.anchor.id;
              var url = "{{ route('companies.show', ['bank' => $bank, 'company' => ':id']) }}"
              url = url.replace(':id', id)
              return '<a href="'+url+'" class="text-decoration-underline text-primary">'+full.anchor.name+'</a>';
            }
          },
          {
            responsivePriority: 1,
            targets: 2,
            render: function (data, type, full, meta) {
              return moment(full.created_at).format('D MMM Y');
            }
          },
          {
            responsivePriority: 1,
            targets: 3,
            render: function (data, type, full, meta) {
              return '<span class="text-success font-bold">'+NumFormatter(full.program_limit)+'</span>';
            }
          },
          {
            // Label
            targets: 4,
            render: function (data, type, full, meta) {
              var $status_number = full['account_status'];
              var $status = {
                active: { title: 'Approved', class: 'bg-label-success' },
                pending: { title: 'Pending', class: ' bg-label-primary' },
                suspended: { title: 'Suspended', class: ' bg-label-danger' },
              };
              if (typeof $status[$status_number] === 'undefined') {
                return data;
              }
              return (
                '<span class="badge ' + $status[$status_number].class + '">' + $status[$status_number].title + '</span>'
              );
            }
          },
          {
            // Actions
            targets: -1,
            title: 'Actions',
            orderable: false,
            searchable: false,
            render: function (data, type, full, meta) {
              var id = full.id;
              var approve_url = "{{ route('programs.status.update', ['bank' => $bank, 'program' => ':id', 'status' => 'active']) }}";
              approve_url = approve_url.replace(':id', id);
              return (
                '<div class="d-inline-block">' +
                '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>' +
                '<ul class="dropdown-menu dropdown-menu-end m-0">' +
                '<li><a href="javascript:;" class="dropdown-item">Details</a></li>' +
                '<li><a href="'+approve_url+'" class="dropdown-item">Approve</a></li>' +
                '</ul>' +
                '</div>'
              );
            }
          }
        ],
        order: [[2, 'desc']],
        dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        displayLength: 7,
        lengthMenu: [7, 10, 25, 50, 75, 100],
        buttons: [
          {
            extend: 'collection',
            className: 'btn btn-primary dropdown-toggle me-2',
            text: '<i class="ti ti-download ti-sm"></i>',
            buttons: [
              // {
              //   extend: 'print',
              //   text: '<i class="ti ti-printer me-1" ></i>Print',
              //   className: 'dropdown-item',
              //   exportOptions: {
              //     columns: [3, 4, 5, 6, 7],
              //     // prevent avatar to be display
              //     format: {
              //       body: function (inner, coldex, rowdex) {
              //         if (inner.length <= 0) return inner;
              //         var el = $.parseHTML(inner);
              //         var result = '';
              //         $.each(el, function (index, item) {
              //           if (item.classList !== undefined && item.classList.contains('user-name')) {
              //             result = result + item.lastChild.firstChild.textContent;
              //           } else if (item.innerText === undefined) {
              //             result = result + item.textContent;
              //           } else result = result + item.innerText;
              //         });
              //         return result;
              //       }
              //     }
              //   },
              //   customize: function (win) {
              //     //customize print view for dark
              //     $(win.document.body)
              //       .css('color', config.colors.headingColor)
              //       .css('border-color', config.colors.borderColor)
              //       .css('background-color', config.colors.bodyBg);
              //     $(win.document.body)
              //       .find('table')
              //       .addClass('compact')
              //       .css('color', 'inherit')
              //       .css('border-color', 'inherit')
              //       .css('background-color', 'inherit');
              //   }
              // },
              {
                extend: 'csv',
                text: '<i class="ti ti-file-text me-1" ></i>Csv',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [3, 4, 5, 6, 7],
                  // prevent avatar to be display
                  format: {
                    body: function (inner, coldex, rowdex) {
                      if (inner.length <= 0) return inner;
                      var el = $.parseHTML(inner);
                      var result = '';
                      $.each(el, function (index, item) {
                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                          result = result + item.lastChild.firstChild.textContent;
                        } else if (item.innerText === undefined) {
                          result = result + item.textContent;
                        } else result = result + item.innerText;
                      });
                      return result;
                    }
                  }
                }
              },
              {
                extend: 'excel',
                text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [3, 4, 5, 6, 7],
                  // prevent avatar to be display
                  format: {
                    body: function (inner, coldex, rowdex) {
                      if (inner.length <= 0) return inner;
                      var el = $.parseHTML(inner);
                      var result = '';
                      $.each(el, function (index, item) {
                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                          result = result + item.lastChild.firstChild.textContent;
                        } else if (item.innerText === undefined) {
                          result = result + item.textContent;
                        } else result = result + item.innerText;
                      });
                      return result;
                    }
                  }
                }
              },
              {
                extend: 'pdf',
                text: '<i class="ti ti-file-description me-1"></i>Pdf',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [3, 4, 5, 6, 7],
                  // prevent avatar to be display
                  format: {
                    body: function (inner, coldex, rowdex) {
                      if (inner.length <= 0) return inner;
                      var el = $.parseHTML(inner);
                      var result = '';
                      $.each(el, function (index, item) {
                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                          result = result + item.lastChild.firstChild.textContent;
                        } else if (item.innerText === undefined) {
                          result = result + item.textContent;
                        } else result = result + item.innerText;
                      });
                      return result;
                    }
                  }
                }
              },
              {
                extend: 'copy',
                text: '<i class="ti ti-copy me-1" ></i>Copy',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [3, 4, 5, 6, 7],
                  // prevent avatar to be display
                  format: {
                    body: function (inner, coldex, rowdex) {
                      if (inner.length <= 0) return inner;
                      var el = $.parseHTML(inner);
                      var result = '';
                      $.each(el, function (index, item) {
                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                          result = result + item.lastChild.firstChild.textContent;
                        } else if (item.innerText === undefined) {
                          result = result + item.textContent;
                        } else result = result + item.innerText;
                      });
                      return result;
                    }
                  }
                }
              }
            ]
          },
          {
            text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add Program</span>',
            className: 'btn btn-primary',
            action: function (e, dt, button, config) {
              window.location.href = '{{ route('programs.create', ['bank' => $bank]) }}'
            }
          }
        ],
      });
    }
  });

  $(function () {
    var dt_active_programs = $('.dt-active-programs'),
      dt_active;

    if (dt_active_programs.length) {
      dt_active = dt_active_programs.DataTable({
        ajax: "{{ route('programs.index', ['bank' => $bank, 'status' => 'active']) }}",
        columns: [
          // { data: 'id' },
          { data: 'name' },
          { data: 'anchor' },
          { data: 'product_type' },
          { data: 'status' },
          { data: 'limit' },
          { data: 'utilized_limit' },
          { data: '' }
        ],
        columnDefs: [
          // {
          //   // For Checkboxes
          //   targets: 0,
          //   orderable: false,
          //   searchable: false,
          //   responsivePriority: 3,
          //   checkboxes: true,
          //   render: function () {
          //     return '<input type="checkbox" class="dt-checkboxes form-check-input">';
          //   },
          //   checkboxes: {
          //     selectAllRender: '<input type="checkbox" class="form-check-input">'
          //   }
          // },
          {
            // Code
            targets: 0,
            responsivePriority: 4,
            render: function (data, type, full, meta) {
              var id = full.id;
              var url = "{{ route('programs.show', ['bank' => $bank, 'program' => ':id']) }}"
              url = url.replace(':id', id)
              return '<a href="'+url+'" class="text-decoration-underline text-primary text-nowrap">'+full.name+'</a>';
            }
          },
          {
            // Anchor
            targets: 1,
            responsivePriority: 4,
            render: function (data, type, full, meta) {
              var id = full.anchor.id;
              var url = "{{ route('companies.show', ['bank' => $bank, 'company' => ':id']) }}"
              url = url.replace(':id', id)
              return '<a href="'+url+'" class="text-decoration-underline text-primary text-nowrap">'+full.anchor.name+'</a>';
            }
          },
          {
            responsivePriority: 1,
            targets: 2,
            render: function (data, type, full, meta) {
              return '<span>'+full.program_type.name+'</span>';
            }
          },
          {
            // Label
            targets: 3,
            render: function (data, type, full, meta) {
              var $status_number = full['account_status'];
              var $status = {
                active: { title: 'Approved', class: 'bg-label-success' },
                pending: { title: 'Pending', class: ' bg-label-primary' },
                suspended: { title: 'Suspended', class: ' bg-label-danger' },
              };
              if (typeof $status[$status_number] === 'undefined') {
                return data;
              }
              return (
                '<span class="badge ' + $status[$status_number].class + '">' + $status[$status_number].title + '</span>'
              );
            }
          },
          {
            responsivePriority: 1,
            targets: 4,
            render: function (data, type, full, meta) {
              return '<span class="text-success font-bold">Ksh. '+NumFormatter(full.program_limit)+'</span>';
            }
          },
          {
            responsivePriority: 1,
            targets: 5,
            render: function (data, type, full, meta) {
              return '<span class="text-success font-bold">Ksh. '+NumFormatter(0)+'</span>';
            }
          },
          {
            // Actions
            targets: -1,
            title: 'Actions',
            orderable: false,
            searchable: false,
            render: function (data, type, full, meta) {
              var id = full.id;
              var map_vendor_url = "{{ route('programs.vendors.map', ['bank' => $bank, 'program' => ':id']) }}";
              var program_details_url = "{{ route('programs.show', ['bank' => $bank, 'program' => ':id']) }}";
              map_vendor_url = map_vendor_url.replace(':id', id);
              program_details_url = program_details_url.replace(':id', id);
              return (
                '<div class="d-inline-flex">' +
                  '<a href="'+program_details_url+'" class="badge bg-label-primary rounded-pill p-1 mx-1" title="View Program Details"><i class="ti ti-eye ti-sm"></i></a>' +
                  '<a href="'+map_vendor_url+'" class="badge bg-label-warning rounded-pill p-1" title="Map Vendors to Program"><i class="ti ti-users ti-sm"></i></a>' +
                '</div>'
              );
            }
          }
        ],
        // order: [[2, 'desc']],
        dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        displayLength: 7,
        lengthMenu: [7, 10, 25, 50, 75, 100],
        buttons: [
          {
            extend: 'collection',
            className: 'btn btn-primary dropdown-toggle me-2',
            text: '<i class="ti ti-download ti-sm"></i>',
            buttons: [
              // {
              //   extend: 'print',
              //   text: '<i class="ti ti-printer me-1" ></i>Print',
              //   className: 'dropdown-item',
              //   exportOptions: {
              //     columns: [3, 4, 5, 6, 7],
              //     // prevent avatar to be display
              //     format: {
              //       body: function (inner, coldex, rowdex) {
              //         if (inner.length <= 0) return inner;
              //         var el = $.parseHTML(inner);
              //         var result = '';
              //         $.each(el, function (index, item) {
              //           if (item.classList !== undefined && item.classList.contains('user-name')) {
              //             result = result + item.lastChild.firstChild.textContent;
              //           } else if (item.innerText === undefined) {
              //             result = result + item.textContent;
              //           } else result = result + item.innerText;
              //         });
              //         return result;
              //       }
              //     }
              //   },
              //   customize: function (win) {
              //     //customize print view for dark
              //     $(win.document.body)
              //       .css('color', config.colors.headingColor)
              //       .css('border-color', config.colors.borderColor)
              //       .css('background-color', config.colors.bodyBg);
              //     $(win.document.body)
              //       .find('table')
              //       .addClass('compact')
              //       .css('color', 'inherit')
              //       .css('border-color', 'inherit')
              //       .css('background-color', 'inherit');
              //   }
              // },
              {
                extend: 'csv',
                text: '<i class="ti ti-file-text me-1" ></i>Csv',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [3, 4, 5, 6, 7],
                  // prevent avatar to be display
                  format: {
                    body: function (inner, coldex, rowdex) {
                      if (inner.length <= 0) return inner;
                      var el = $.parseHTML(inner);
                      var result = '';
                      $.each(el, function (index, item) {
                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                          result = result + item.lastChild.firstChild.textContent;
                        } else if (item.innerText === undefined) {
                          result = result + item.textContent;
                        } else result = result + item.innerText;
                      });
                      return result;
                    }
                  }
                }
              },
              {
                extend: 'excel',
                text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [3, 4, 5, 6, 7],
                  // prevent avatar to be display
                  format: {
                    body: function (inner, coldex, rowdex) {
                      if (inner.length <= 0) return inner;
                      var el = $.parseHTML(inner);
                      var result = '';
                      $.each(el, function (index, item) {
                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                          result = result + item.lastChild.firstChild.textContent;
                        } else if (item.innerText === undefined) {
                          result = result + item.textContent;
                        } else result = result + item.innerText;
                      });
                      return result;
                    }
                  }
                }
              },
              {
                extend: 'pdf',
                text: '<i class="ti ti-file-description me-1"></i>Pdf',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [3, 4, 5, 6, 7],
                  // prevent avatar to be display
                  format: {
                    body: function (inner, coldex, rowdex) {
                      if (inner.length <= 0) return inner;
                      var el = $.parseHTML(inner);
                      var result = '';
                      $.each(el, function (index, item) {
                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                          result = result + item.lastChild.firstChild.textContent;
                        } else if (item.innerText === undefined) {
                          result = result + item.textContent;
                        } else result = result + item.innerText;
                      });
                      return result;
                    }
                  }
                }
              },
              {
                extend: 'copy',
                text: '<i class="ti ti-copy me-1" ></i>Copy',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [3, 4, 5, 6, 7],
                  // prevent avatar to be display
                  format: {
                    body: function (inner, coldex, rowdex) {
                      if (inner.length <= 0) return inner;
                      var el = $.parseHTML(inner);
                      var result = '';
                      $.each(el, function (index, item) {
                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                          result = result + item.lastChild.firstChild.textContent;
                        } else if (item.innerText === undefined) {
                          result = result + item.textContent;
                        } else result = result + item.innerText;
                      });
                      return result;
                    }
                  }
                }
              }
            ]
          },
          {
            text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add Program</span>',
            className: 'btn btn-primary',
            action: function (e, dt, button, config) {
              window.location.href = '{{ route('programs.create', ['bank' => $bank]) }}'
            }
          }
        ],
      });
    }
  });
</script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="fw-light">Programs</span>
</h4>

<div class="row match-height">
  <div class="col-lg-3 col-sm-12 mb-4">
    <div class="card h-100 border border-primary">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">
          <h5 class="mb-0 me-2">{{ count($pending_programs) }}</h5>
          <small>Pending Approval</small>
        </div>
        <div class="card-icon">
          <span class="badge bg-label-primary rounded-pill p-2">
            <i class='ti ti-circle-check ti-sm'></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-2 col-6 mb-4">
    <div class="card h-100">
      <div class="card-body text-center">
        <div class="badge rounded-pill p-2 bg-label-info mb-2"><i class="ti ti-upload ti-sm"></i></div>
        <h6 class="card-title mb-2">Upload Programs</h6>
      </div>
    </div>
  </div>
</div>

<div class="nav-align-top nav-tabs-shadow mb-4">
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <button type="button" class="nav-link active text-uppercase" role="tab" data-bs-toggle="tab" data-bs-target="#navs-all-invoices" aria-controls="navs-all-invoices" aria-selected="true">Pending Approval</button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link text-sm text-uppercase" role="tab" data-bs-toggle="tab" data-bs-target="#navs-active-programs" aria-controls="navs-active-programs" aria-selected="false">Programs</button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link text-sm text-uppercase" role="tab" data-bs-toggle="tab" data-bs-target="#navs-cbs-transactions" aria-controls="navs-cbs-transactions" aria-selected="false">Exhausted Programs</button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link text-sm text-uppercase" role="tab" data-bs-toggle="tab" data-bs-target="#navs-expired-programs" aria-controls="navs-expired-programs" aria-selected="false">Expired Programs</button>
    </li>
  </ul>
  <div class="tab-content mt-4">
    <div class="tab-pane fade show active" id="navs-all-invoices" role="tabpanel">
      <!-- Pending Programs Table -->
      {{-- <div class="p-3 d-flex justify-content-between">
        <div class="d-flex flex-wrap">
          <div class="">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Program Code" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Anchor" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Limit" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
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
          <a href="{{ route('programs.create', ['bank' => request()->route('bank')]) }}">
            <button type="button" class="btn btn-primary" style="margin-right: 10px;">Add Program</button>
          </a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr class="">
              <th>Program Code</th>
              <th>Anchor Name</th>
              <th>Date Added</th>
              <th>Limit</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <tr class="text-nowrap">
              <td><span class="text-primary text-decoration-underline">Pr2398</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td>24 Nov 2023</td>
              <td class="text-success">Ksh 51000</td>
              <td><span class="badge bg-label-warning me-1">Pending Approval</span></td>
            </tr>
            <tr class="text-nowrap">
              <td><span class="text-primary text-decoration-underline">Pr2398</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td>24 Nov 2023</td>
              <td class="text-success">Ksh 51000</td>
              <td><span class="badge bg-label-warning me-1">Pending Approval</span></td>
            </tr>
            <tr class="text-nowrap">
              <td><span class="text-primary text-decoration-underline">Pr2398</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td>24 Nov 2023</td>
              <td class="text-success">Ksh 51000</td>
              <td><span class="badge bg-label-warning me-1">Pending Approval</span></td>
            </tr>
            <tr class="text-nowrap">
              <td><span class="text-primary text-decoration-underline">Pr2398</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td>24 Nov 2023</td>
              <td class="text-success">Ksh 51000</td>
              <td><span class="badge bg-label-warning me-1">Pending Approval</span></td>
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
      </nav> --}}
      <div class="table-responsive p-2">
        <table class="table dt-pending-programs">
          <thead>
            <tr class="">
              <th>Program Code</th>
              <th>Anchor Name</th>
              <th>Date Added</th>
              <th>Limit</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <div class="tab-pane fade show" id="navs-active-programs" role="tabpanel">
      {{-- <div class="p-3 d-flex justify-content-between">
        <div class="d-flex flex-wrap">
          <div class="">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Program Name" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Company Name" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="OD Account No" aria-describedby="defaultFormControlHelp" />
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
          <a href="{{ route('programs.create', ['bank' => request()->route('bank')]) }}">
            <button type="button" class="btn btn-primary h-50 text-nowrap" style="margin-right: 10px;">Add Program</button>
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
              <th>Program Name</th>
              <th>Company Name</th>
              <th>Product Type</th>
              <th>Product Code</th>
              <th>Status</th>
              <th>Total Program Limit</th>
              <th>Utilized Limit</th>
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
              <td><span class="text-primary text-decoration-underline">Pr3878</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="">Vendor Financing</td>
              <td>VFR</td>
              <td><span class="badge bg-label-success me-1">Approved</span></td>
              <td class="text-success">Ksh 10,000,000</td>
              <td>0</td>
              <td class="">
                <i class='ti ti-file-dollar ti-sm text-primary'></i>
                <i class='ti ti-circle-check ti-sm text-success'></i>
                <i class='ti ti-letter-x ti-sm text-danger'></i>
                <i class='ti ti-trash ti-sm text-secondary'></i>
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
      </nav> --}}
      <div class="table-responsive p-2">
        <table class="table dt-active-programs">
          <thead>
            <tr class="">
              <th>Program Name</th>
              <th>Anchor Name</th>
              <th>Product Type</th>
              <th>Status</th>
              <th>Total Program Limit</th>
              <th>Uitlized Limit</th>
              <th>Actions</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <div class="tab-pane fade show" id="navs-cbs-transactions" role="tabpanel">
      <div class="p-3 d-flex justify-content-between">
        <div class="d-flex flex-wrap">
          <div class="">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Program Name" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Anchor" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Limit" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
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
          <a href="{{ route('programs.create', ['bank' => request()->route('bank')]) }}">
            <button type="button" class="btn btn-primary text-nowrap" style="margin-right: 10px;">Add Program</button>
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
              <th>Program Code</th>
              <th>Anchor Name</th>
              <th>Financing Limit</th>
              <th>Available Limit</th>
              <th>No of Vendors</th>
              <th>Anchor Repayment Amount</th>
              <th>Pipeline Amount</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <tr class="text-nowrap">
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                </div>
              </td>
              <td><span class="text-primary text-decoration-underline">Pr3878</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-success">Ksh 10,000,000</td>
              <td class="text-success">Ksh 0</td>
              <td>2</td>
              <td class="text-success">Ksh 2,000,000</td>
              <td class="text-success">Ksh 20,000</td>
            </tr>
            <tr class="text-nowrap">
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                </div>
              </td>
              <td><span class="text-primary text-decoration-underline">Pr3878</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-success">Ksh 10,000,000</td>
              <td class="text-success">Ksh 0</td>
              <td>2</td>
              <td class="text-success">Ksh 2,000,000</td>
              <td class="text-success">Ksh 20,000</td>
            </tr>
            <tr class="text-nowrap">
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                </div>
              </td>
              <td><span class="text-primary text-decoration-underline">Pr3878</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-success">Ksh 10,000,000</td>
              <td class="text-success">Ksh 0</td>
              <td>2</td>
              <td class="text-success">Ksh 2,000,000</td>
              <td class="text-success">Ksh 20,000</td>
            </tr>
            <tr class="text-nowrap">
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                </div>
              </td>
              <td><span class="text-primary text-decoration-underline">Pr3878</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-success">Ksh 10,000,000</td>
              <td class="text-success">Ksh 0</td>
              <td>2</td>
              <td class="text-success">Ksh 2,000,000</td>
              <td class="text-success">Ksh 20,000</td>
            </tr>
            <tr class="text-nowrap">
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                </div>
              </td>
              <td><span class="text-primary text-decoration-underline">Pr3878</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-success">Ksh 10,000,000</td>
              <td class="text-success">Ksh 0</td>
              <td>2</td>
              <td class="text-success">Ksh 2,000,000</td>
              <td class="text-success">Ksh 20,000</td>
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
    <div class="tab-pane fade show" id="navs-expired-programs" role="tabpanel">
      <div class="p-3 d-flex justify-content-between">
        <div class="d-flex flex-wrap">
          <div class="">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Program Name" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Anchor" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Limit" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="mx-2">
            <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
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
          <a href="{{ route('programs.create', ['bank' => request()->route('bank')]) }}">
            <button type="button" class="btn btn-primary text-nowrap" style="margin-right: 10px;">Add Program</button>
          </a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table dt-programs">
          <thead>
            <tr class="">
              <th>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
              </th>
              <th>Program Code</th>
              <th>Anchor Name</th>
              <th>Financing Limit</th>
              <th>Available Limit</th>
              <th>No of Vendors</th>
              <th>Anchor Repayment Amount</th>
              <th>Pipeline Amount</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <tr class="text-nowrap">
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                </div>
              </td>
              <td><span class="text-primary text-decoration-underline">Pr3878</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-success">Ksh 10,000,000</td>
              <td class="text-success">Ksh 0</td>
              <td>2</td>
              <td class="text-success">Ksh 2,000,000</td>
              <td class="text-success">Ksh 20,000</td>
            </tr>
            <tr class="text-nowrap">
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                </div>
              </td>
              <td><span class="text-primary text-decoration-underline">Pr3878</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-success">Ksh 10,000,000</td>
              <td class="text-success">Ksh 0</td>
              <td>2</td>
              <td class="text-success">Ksh 2,000,000</td>
              <td class="text-success">Ksh 20,000</td>
            </tr>
            <tr class="text-nowrap">
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                </div>
              </td>
              <td><span class="text-primary text-decoration-underline">Pr3878</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-success">Ksh 10,000,000</td>
              <td class="text-success">Ksh 0</td>
              <td>2</td>
              <td class="text-success">Ksh 2,000,000</td>
              <td class="text-success">Ksh 20,000</td>
            </tr>
            <tr class="text-nowrap">
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                </div>
              </td>
              <td><span class="text-primary text-decoration-underline">Pr3878</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-success">Ksh 10,000,000</td>
              <td class="text-success">Ksh 0</td>
              <td>2</td>
              <td class="text-success">Ksh 2,000,000</td>
              <td class="text-success">Ksh 20,000</td>
            </tr>
            <tr class="text-nowrap">
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                </div>
              </td>
              <td><span class="text-primary text-decoration-underline">Pr3878</span></td>
              <td class="text-primary text-decoration-underline">1Account</td>
              <td class="text-success">Ksh 10,000,000</td>
              <td class="text-success">Ksh 0</td>
              <td>2</td>
              <td class="text-success">Ksh 2,000,000</td>
              <td class="text-success">Ksh 20,000</td>
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
