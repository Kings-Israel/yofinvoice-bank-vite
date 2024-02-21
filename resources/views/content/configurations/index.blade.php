@extends('layouts/layoutMaster')

@section('title', 'Configurations')

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
  .tab-content {
    padding: 0px !important;
  }
  .no-label {
    margin-left: -187px !important;
  }
  .checkbox {
    margin-left: 100px !important;
  }
  .yes-label {
    margin-left: 54px !important;
  }
  .no-label-2 {
    margin-left: -65px !important;
  }
  .yes-label-2 {
    margin-left: 38px !important;
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
<script src="{{asset('assets/js/ui-modals.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="fw-light">Configurations</span>
</h4>
<div class="nav-align-top mb-4">
  <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
    <li class="nav-item">
      <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-bank-details" aria-controls="navs-pills-bank-details" aria-selected="true"><i class="tf-icons ti ti-file-text ti-xs me-1"></i> Basic Configurations</button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-configurations" aria-controls="navs-pills-configurations" aria-selected="false"><i class="tf-icons ti ti-clipboard-check ti-xs me-1"></i> Vendor Financing Configurations</button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-maker-checker" aria-controls="navs-pills-maker-checker" aria-selected="false"><i class="tf-icons ti ti-folders ti-xs me-1"></i> Dealer Financing Configurations</button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-po-settings" aria-controls="navs-pills-po-settings" aria-selected="false"><i class="tf-icons ti ti-settings ti-xs me-1"></i> System Configurations</button>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade show active" style="background: #F8F7FA;" id="navs-pills-bank-details" role="tabpanel">
      <div class="" style="background: #ffffff;">
        <h5 class="fw-bold py-3 mb-2">
          <span class="fw-light px-3">WHT Configuration</span>
        </h5>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">TDS Net - TDS receivable GL</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="1" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">TDS Net - TDS payable GL</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="1" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">TDS Gross - TDS receivable GL</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="1" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="" style="background: #ffffff;">
        <h5 class="fw-bold py-3 mb-2">
          <span class="fw-light px-3">Bank GLs</span>
        </h5>
        <div class="row px-3 mb-2">
          <div class="col-md-3 d-flex flex-column">
            <label for="html5-text-input" class="col-form-label">Advance Discount Amount</label>
          </div>
          <div class="col-md-4">
            <input class="form-control" type="text" value="Acc_Dis_873" id="html5-text-input" />
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3 d-flex flex-column">
            <label for="html5-text-input" class="col-form-label">Discount Receivable Account</label>
          </div>
          <div class="col-md-4">
            <input class="form-control" type="text" value="Acc_Rec_45674" id="html5-text-input" />
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3 d-flex flex-column">
            <label for="html5-text-input" class="col-form-label">Discount Income Account</label>
          </div>
          <div class="col-md-4">
            <input class="form-control" type="text" value="Acc_Disc_income" id="html5-text-input" />
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3 d-flex flex-column">
            <label for="html5-text-input" class="col-form-label">Fee Income Account</label>
          </div>
          <div class="col-md-4">
            <input class="form-control" type="text" value="Acc_Fee_income" id="html5-text-input" />
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3 d-flex flex-column">
            <label for="html5-text-input" class="col-form-label">Advance Discount Amount</label>
          </div>
          <div class="col-md-4">
            <input class="form-control" type="text" value="Acc_Disc_income" id="html5-text-input" />
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3 d-flex flex-column">
            <label for="html5-text-input" class="col-form-label">Unrealised Discount Account</label>
          </div>
          <div class="col-md-4">
            <input class="form-control" type="text" value="Acc_Unre_Dic_income" id="html5-text-input" />
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3 d-flex flex-column">
            <label for="html5-text-input" class="col-form-label">Tax Account</label>
          </div>
          <div class="col-md-4">
            <input class="form-control" type="text" value="Acc_Tax" id="html5-text-input" />
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-end my-2 mx-3">
        <button class="btn btn-secondary">
          Cancel
        </button>
        <button class="btn btn-primary" style="margin-left: 10px;">
          Submit
        </button>
      </div>
      <br>
      <div class="" style="background: #ffffff;">
        <div class="d-flex justify-content-between">
          <h5 class="fw-light px-3">Company KYC Documents</h5>
          <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#requestDocumentsModal">Add Document</button>
          <div class="modal modal-top fade" id="requestDocumentsModal" tabindex="-1">
            <div class="modal-dialog">
              <form class="modal-content" method="POST" action="{{ route('configurations.compliance.document.add', ['bank' => $bank]) }}">
                @csrf
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTopTitle">Add KYC Document</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nameSlideTop" class="form-label">Enter Document Name</label>
                    <input class="form-control" id="" name="name" />
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <form action="{{ route('configurations.compliance.documents.update', ['bank' => $bank]) }}" method="post">
          @csrf
          <div class="d-flex mb-2">
            @foreach ($documents as $document)
              <div class="mx-3 d-flex">
                <input class="form-control" type="text" name="name[{{ $document->name }}]" value="{{ $document->name }}" id="html5-text-input" />
                <a href="{{ route('configurations.compliance.documents.delete', ['bank' => $bank, 'bank_document' => $document]) }}" title="Delete {{ $document->name }}" class="mx-2 my-auto">
                  <i class="tf-icons ti ti-trash text-danger"></i>
                </a>
              </div>
              {{-- <div class="col-md-6 d-flex justify-content-center text-nowrap">
                <div class="form-check form-switch mb-2">
                  <label class="form-check-label" for="flexSwitchCheckChecked" style="margin-left: -240px;">Doesn't Requires Expiry Date</label>
                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" style="margin-left: 180px;" name="requires_expiry_date" @if($document->requires_expiry_date) checked @endif>
                  <label class="form-check-label" for="flexSwitchCheckChecked" style="margin-left: 40px;">Requires Expiry Date</label>
                </div>
              </div> --}}
            @endforeach
          </div>
          <div class="d-flex my-2 mx-3">
            <button class="btn btn-primary" type="submit">
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="tab-pane fade" id="navs-pills-configurations" role="tabpanel">
      <h5 class="fw-bold py-3 mb-2">
        <span class="px-3">Vendor Financing Configurations</span>
      </h5>
      <div class="card">
        <h5 class="fw-bold py-3 mb-2">
          <span class="px-3">Specific Configuration</span>
        </h5>
        <h6 class="text-primary my-4 mx-3">Anchor Finance Payable</h6>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Advance Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="AFP_Adv_Int_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Receivable Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Income Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Unrealised Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <h6 class="text-primary my-4 mx-3">Anchor Finance Receivable</h6>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Advance Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="AFP_Adv_Int_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Receivable Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Income Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Unrealised Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <h6 class="text-primary my-4 mx-3">Vendor Finance Receivable</h6>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Advance Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="AFP_Adv_Int_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Receivable Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Income Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Unrealised Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Fee Income Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Penal Discount Income Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Penal Discount Receivable Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        {{-- Factoring Without Recourse --}}
        <h6 class="text-primary my-4 mx-3">Factoring Without Recourse</h6>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Advance Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="AFP_Adv_Int_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Receivable Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Income Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Unrealised Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        {{-- End Factoring Without Recourse --}}
        {{-- Factoring With Recourse --}}
        <h6 class="text-primary my-4 mx-3">Factoring With Recourse</h6>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Advance Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="AFP_Adv_Int_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Receivable Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Income Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Unrealised Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Fee Income Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Penal Discount Income Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Penal Discount Receivable Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        {{-- End Factoring With Recourse --}}
        {{-- Purchase Invoice Discounting --}}
        <h6 class="text-primary my-4 mx-3">Vendor Finance Receivable</h6>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Advance Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="AFP_Adv_Int_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Receivable Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Income Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Unrealised Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        {{-- End Purchase Invoice Discounting --}}
        {{-- Sales Invoice Discounting --}}
        <h6 class="text-primary my-4 mx-3">Vendor Finance Receivable</h6>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Advance Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="AFP_Adv_Int_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Receivable Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Income Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Unrealised Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        {{-- End Sales Invoice Discounting --}}
        {{-- Reverse Factoring --}}
        <h6 class="text-primary my-4 mx-3">Vendor Finance Receivable</h6>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Advance Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="AFP_Adv_Int_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Receivable Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Discount Income Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Unrealised Discount Account</label>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
        </div>
        {{-- End Reverse Factoring --}}
        <div class="row px-3 mb-2">
          <div class="col-md-8 d-flex flex-column">
            <label for="html5-text-input" class="col-form-label">Payment Reminder To Anchor</label>
            <small>No. of days before which remainder mail for invoices nearing due date will be sent to anchor</small>
          </div>
          <div class="col-md-4">
            <input class="form-control" type="number" placeholder="8" id="html5-text-input" />
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-8 d-flex flex-column">
            <label for="html5-text-input" class="col-form-label">Send Daily Payment Reminder for overdue loans</label>
            <small>If selected, an email remainder will be sent daily till the payment is closed</small>
          </div>
          <div class="col-md-4">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label-2" for="flexSwitchCheckChecked">No</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label-2" for="flexSwitchCheckChecked">Yes</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-8 d-flex flex-column">
            <label for="html5-text-input" class="col-form-label">Rate Limit(%)</label>
            <small>Percentage Mentioned Here will be retained from vendor's available limit for handling of discount postings. Remaining amount will be available to the vendors to request finance</small>
          </div>
          <div class="col-md-4">
            <input class="form-control" type="number" placeholder="0" id="html5-text-input" />
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-8 d-flex flex-column">
            <label for="html5-text-input" class="col-form-label">Maturity Handling on Weekend</label>
            <small>Select when do you wish to mature the payment if it fails on a weekend or holiday</small>
          </div>
          <div class="col-md-4">
            <input class="form-control" type="text" placeholder="No Effect" id="html5-text-input" />
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-8 d-flex flex-column">
            <label for="html5-text-input" class="col-form-label">Allow Finance if overdue</label>
            <small>If set to NO, a vendor having any open overdue payment will not be allowed to take further finance</small>
          </div>
          <div class="col-md-4">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label-2" for="flexSwitchCheckChecked">No</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label-2" for="flexSwitchCheckChecked">Yes</label>
            </div>
          </div>
        </div>
        {{-- Maker Checker --}}
        <h6 class="text-primary my-4 mx-3">Maker / Checker</h6>
        <div class="row px-3 mb-2">
          <div class="col-md-8 d-flex flex-column">
            <label for="html5-text-input" class="col-form-label">Finance Request Approval</label>
          </div>
          <div class="col-md-4">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label-2" for="flexSwitchCheckChecked">No</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label-2" for="flexSwitchCheckChecked">Yes</label>
            </div>
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-8 d-flex flex-column">
            <label for="html5-text-input" class="col-form-label">VF Takeover Transactions</label>
          </div>
          <div class="col-md-4">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label-2" for="flexSwitchCheckChecked">No</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
              <label class="form-check-label yes-label-2" for="flexSwitchCheckChecked">Yes</label>
            </div>
          </div>
        </div>
        {{-- End Maker Checker --}}
        <h6 class="text-primary my-4 mx-3">VF - Repayment Priorities</h6>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Fees and Charges</label>
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="1" id="html5-text-input" />
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Interest</label>
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="0" id="html5-text-input" />
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Principle</label>
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="2" id="html5-text-input" />
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Penal Interest</label>
          </div>
          <div class="col-md-6 d-flex justify-content-center text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
          <div class="col-md-3">
            <input class="form-control" type="number" value="3" id="html5-text-input" />
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-end my-2 mx-3">
        <button class="btn btn-secondary">
          Cancel
        </button>
        <button class="btn btn-primary" style="margin-left: 10px;">
          Submit
        </button>
      </div>
    </div>
    <div class="tab-pane fade" id="navs-pills-maker-checker" role="tabpanel">
      <h5 class="fw-bold py-3 mb-2">
        <span class="fw-light px-3">Dealer Financing Configurations</span>
      </h5>
      <h6 class="text-primary my-4 mx-3">Specific Configurations</h6>
      <div class="row px-3 mb-2">
        <div class="col-md-5 d-flex flex-column">
          <label for="html5-text-input" class="col-form-label">Discount Receivable From Overdraft</label>
          <small>Select the GL Account Number used by the bank to accrue discount</small>
        </div>
        <div class="col-md-3">
          <input class="form-control" type="number" value="AFP_Adv_Int_acc" id="html5-text-input" />
        </div>
        <div class="col-md-4 d-flex justify-content-end text-nowrap">
          <div class="form-check form-switch mb-2">
            <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
            <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
          </div>
        </div>
      </div>
      <div class="row px-3 mb-2">
        <div class="col-md-5 d-flex flex-column">
          <label for="html5-text-input" class="col-form-label">Discount Income Account</label>
          <small>Select the GL Account Number used by the bank to realize discount</small>
        </div>
        <div class="col-md-3">
          <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
        </div>
        <div class="col-md-4 d-flex justify-content-end text-nowrap">
          <div class="form-check form-switch mb-2">
            <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
            <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
          </div>
        </div>
      </div>
      <div class="row px-3 mb-2">
        <div class="col-md-5 d-flex flex-column">
          <label for="html5-text-input" class="col-form-label">Fee Income Account</label>
          <small>If charging any fees on every drawdown, then select respective GL where the income will be recognized. No need to select any GL if not charging any fees</small>
        </div>
        <div class="col-md-3">
          <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
        </div>
        <div class="col-md-4 d-flex justify-content-end text-nowrap">
          <div class="form-check form-switch mb-2">
            <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
            <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
          </div>
        </div>
      </div>
      <div class="row px-3 mb-2">
        <div class="col-md-5">
          <label for="html5-text-input" class="col-form-label">Unrealised Discount Account</label>
        </div>
        <div class="col-md-3">
          <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
        </div>
        <div class="col-md-4 d-flex justify-content-end text-nowrap">
          <div class="form-check form-switch mb-2">
            <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
            <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
          </div>
        </div>
      </div>
      <div class="row px-3 mb-2">
        <div class="col-md-5">
          <label for="html5-text-input" class="col-form-label">Tax Account Number</label>
        </div>
        <div class="col-md-3">
          <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
        </div>
        <div class="col-md-4 d-flex justify-content-end text-nowrap">
          <div class="form-check form-switch mb-2">
            <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
            <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
          </div>
        </div>
      </div>
      <div class="row px-3 mb-2">
        <div class="col-md-5 d-flex flex-column">
          <label for="html5-text-input" class="col-form-label">Penal Discount Income Account</label>
          <small>Select the GL Account Number used by the bank to accrue penal interest</small>
        </div>
        <div class="col-md-3">
          <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
        </div>
        <div class="col-md-4 d-flex justify-content-end text-nowrap">
          <div class="form-check form-switch mb-2">
            <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
            <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
          </div>
        </div>
      </div>
      <div class="row px-3 mb-2">
        <div class="col-md-5 d-flex flex-column">
          <label for="html5-text-input" class="col-form-label">Penal Discount Receivable Account</label>
          <small>Select the GL Account Number used by the bank to accrue penal interest receivable</small>
        </div>
        <div class="col-md-3">
          <input class="form-control" type="number" value="Pay_Int_Rec_acc" id="html5-text-input" />
        </div>
        <div class="col-md-4 d-flex justify-content-end text-nowrap">
          <div class="form-check form-switch mb-2">
            <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
            <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
          </div>
        </div>
      </div>
      <h6 class="text-primary my-4 mx-3">DF - Repayment Priorities</h6>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Fees and Charges</label>
          </div>
          <div class="col-md-5 d-flex justify-content-end text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
          <div class="col-md-2">
            <input class="form-control" type="number" value="1" id="html5-text-input" />
          </div>
          <div class="col-md-2">
            <input class="form-control" type="number" value="1" id="html5-text-input" />
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Interest</label>
          </div>
          <div class="col-md-5 d-flex justify-content-end text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
          <div class="col-md-2">
            <input class="form-control" type="number" value="0" id="html5-text-input" />
          </div>
          <div class="col-md-2">
            <input class="form-control" type="number" value="1" id="html5-text-input" />
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Principle</label>
          </div>
          <div class="col-md-5 d-flex justify-content-end text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
          <div class="col-md-2">
            <input class="form-control" type="number" value="2" id="html5-text-input" />
          </div>
          <div class="col-md-2">
            <input class="form-control" type="number" value="1" id="html5-text-input" />
          </div>
        </div>
        <div class="row px-3 mb-2">
          <div class="col-md-3">
            <label for="html5-text-input" class="col-form-label">Penal Interest</label>
          </div>
          <div class="col-md-5 d-flex justify-content-end text-nowrap">
            <div class="form-check form-switch mb-2">
              <label class="form-check-label no-label" for="flexSwitchCheckChecked">Not Branch Specific</label>
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label yes-label" for="flexSwitchCheckChecked">Branch Specific</label>
            </div>
          </div>
          <div class="col-md-2">
            <input class="form-control" type="number" value="3" id="html5-text-input" />
          </div>
          <div class="col-md-2">
            <input class="form-control" type="number" value="1" id="html5-text-input" />
          </div>
        </div>
      <div class="d-flex justify-content-end my-2 mx-3">
        <button class="btn btn-secondary">
          Cancel
        </button>
        <button class="btn btn-primary" style="margin-left: 10px;">
          Submit
        </button>
      </div>
    </div>
    <div class="tab-pane fade" id="navs-pills-po-settings" role="tabpanel">
      <h5 class="fw-bold py-3 mb-2">
        <span class="fw-light px-3">PO Settings</span>
      </h5>
      <div class="row px-3 mb-2">
        <div class="col-md-6 border-bottom d-flex flex-column">
          <label for="html5-text-input" class="col-form-label">Company Logo</label>
          <small>Recommended size 160 x 80 pixels, image format PNG/JPG</small>
        </div>
        <div class="col-md-6">
          <input class="form-control" type="file" id="formFile">
        </div>
      </div>
      <div class="row px-3 mb-2">
        <div class="col-md-6 d-flex flex-column">
          <label for="" class="col-form-label">PO Description</label>
          <small>Will be shown in invoice as description</small>
        </div>
        <div class="col-md-6">
          <div id="snow-toolbar" style="background-color: #e4e4e4">
            <span class="ql-formats">
              <button class="ql-bold"></button>
              <button class="ql-italic"></button>
              <button class="ql-underline"></button>
            </span>
          </div>
          <div id="snow-editor">
          </div>
        </div>
      </div>
      <div class="row px-3 mb-2">
        <div class="col-md-6 d-flex flex-column">
          <label for="html5-text-input" class="col-form-label">PO Footer</label>
          <small>Will be shown in invoice footer</small>
        </div>
        <div class="col-md-6">
          <input class="form-control" type="text" placeholder="PO Footer" id="html5-text-input" />
        </div>
      </div>
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
</div>
@endsection
