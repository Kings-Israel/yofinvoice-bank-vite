@extends('layouts/layoutMaster')

@section('title', 'Company Details')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/ui-modals.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-2 mb-2"><span class="fw-light">Company Details</span></h4>

<h4 class="fw-bold py-2 mb-1"><span class="fw-light">Company ID</span><strong>#{{ $company->business_identification_number }}</strong></h4>

<h6>{{ $company->created_at->format('M d Y, H:i A') }}</h6>

<!-- Examples -->
<div class="row mb-5">
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card h-100">
      <div class="card-body">
        {{-- <img class="img-fluid d-flex mx-auto my-4 rounded" src="{{asset('assets/img/elements/4.jpg')}}" alt="Card image cap" /> --}}
        <h4 class="card-text text-center fw-bold">{{ $company->name }}</h4>
        <small class="card-text text-center">Company ID <strong>#{{ $company->unique_identification_number }}</strong></small>
        <hr>
        <h5><strong>Username: </strong>Ubunifu Ltd</h5>
        <h5><strong>Email: </strong>admin@ubunifu.com</h5>
        <div class="d-flex mb-2" style="height: 25px">
          <h5 class="me-2"><strong>Approval Status:</strong></h5>
          <span class="badge {{ $company->resolveApprovalStatus() }} me-1">{{ Str::title($company->approval_status) }}</span>
        </div>
        <div class="d-flex mb-2" style="height: 25px">
          <h5 class="me-2"><strong>Active Status:</strong></h5>
          <span class="badge {{ $company->resolveStatus() }} me-1">{{ Str::title($company->status) }}</span>
        </div>
        <h5><strong>Phone: </strong>(+254) 3454 4532</h5>
        <h5><strong>City: </strong>{{ Str::title($company->city) }}</h5>
        <h5><strong>Industry: </strong>{{ Str::title($company->business_segment) }}</h5>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-8">
    <div class="card">
      <div class="d-flex justify-content-between m-2">
        <h4 class="">Compliance Documents</h4>
        @if ($company->status == 'approved')
          <button class="btn btn-label-secondary mx-2" data-bs-toggle="modal" data-bs-target="#requestDocumentsModal">Request Documents</button>
          <div class="modal modal-top fade" id="requestDocumentsModal" tabindex="-1">
            <div class="modal-dialog">
              <form class="modal-content" method="POST" action="{{ route('companies.documents.request', ['bank' => $bank, 'company' => $company]) }}">
                @csrf
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTopTitle">Request More Compliance Documents</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nameSlideTop" class="form-label">Enter Documents (each document separated by a comma)</label>
                    <input class="form-control" id="" name="documents" />
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        @endif
      </div>
      <div class="card-body">
        <div class="accordion" id="accordionStyle1">
          @forelse ($company->documents as $key => $document)
            <div class="accordion-item card">
              <div class="accordion-header p-1 d-flex justify-content-between">
                <h2 class="">
                  <button type="button" class="accordion-button collapsed px-2 py-0" data-bs-toggle="collapse" data-bs-target="#accordionStyle1-{{ $key }}" aria-expanded="false">
                    {{ $document->name }} <span class="badge {{ $document->resolveStatus() }} rounded-lg mx-1">{{ Str::title($document->status) }}</span> @if ($document->expiry_date)<span class="badge bg-label-success mx-1">Expires in {{ Carbon\Carbon::parse($document->expiry_date)->format('Y') }}</span> @endif
                  </button>
                </h2>
                <div class="d-flex">
                  @if ($document->status == 'pending')
                    <button class="btn btn-label-danger mx-2" data-bs-toggle="modal" data-bs-target="#rejectDocumentModal-{{ $document->id }}">Reject</button>
                    <div class="modal modal-top fade" id="rejectDocumentModal-{{ $document->id }}" tabindex="-1">
                      <div class="modal-dialog">
                        <form class="modal-content" method="POST" action="{{ route('companies.documents.status.update', ['bank' => $bank, 'company' => $company]) }}">
                          @csrf
                          <input type="hidden" name="status" value="rejected">
                          <input type="hidden" name="document_id" value="{{ $document->id }}">
                          <div class="modal-header">
                            <h5 class="modal-title" id="modalTopTitle">Rejection Reason</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <label for="nameSlideTop" class="form-label">Enter Rejection Reason</label>
                              <textarea class="form-control" id="" name="rejected_reason" rows="3"></textarea>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <form action="{{ route('companies.documents.status.update', ['bank' => $bank, 'company' => $company]) }}" method="post">
                      @csrf
                      <input type="hidden" name="status" value="approved">
                      <input type="hidden" name="document_id" value="{{ $document->id }}">
                      <button type="submit" class="btn btn-label-primary">Approve</button>
                    </form>
                  @elseif($document->status == 'rejected')
                    <form action="{{ route('companies.documents.status.update', ['bank' => $bank, 'company' => $company]) }}" method="post">
                      @csrf
                      <input type="hidden" name="status" value="approved">
                      <input type="hidden" name="document_id" value="{{ $document->id }}">
                      <button type="submit" class="btn btn-label-primary">Approve</button>
                    </form>
                  @elseif ($document->status == 'approved')
                    <button class="btn btn-label-secondary mx-2" data-bs-toggle="modal" data-bs-target="#rejectDocumentModal-{{ $document->id }}">Reject</button>
                    <div class="modal modal-top fade" id="rejectDocumentModal-{{ $document->id }}" tabindex="-1">
                      <div class="modal-dialog">
                        <form class="modal-content" method="POST" action="{{ route('companies.documents.status.update', ['bank' => $bank, 'company' => $company]) }}">
                          @csrf
                          <input type="hidden" name="status" value="rejected">
                          <input type="hidden" name="document_id" value="{{ $document->id }}">
                          <div class="modal-header">
                            <h5 class="modal-title" id="modalTopTitle">Rejection Reason for {{ $document->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <label for="nameSlideTop" class="form-label">Enter Rejection Reason</label>
                              <textarea class="form-control" id="" name="rejected_reason" rows="3"></textarea>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  @endif
                </div>
              </div>
              <div id="accordionStyle1-{{ $key }}" class="accordion-collapse collapse" data-bs-parent="#accordionStyle1">
                <div class="accordion-body">
                  <div class="d-flex">
                    <a href="https://yofinvoice.deveint.live/crm/storage/{{ $document->path }}" target="_blank" class="btn btn-sm btn-success">View {{ $document->original_name }}</a>
                    {{-- <a href="http://crm.yofinvoice.deveint/crm/storage/{{ $document->path }}" target="_blank" class="btn btn-sm btn-success">View {{ $document->original_name }}</a> --}}
                  </div>
                  @if ($document->rejected_reason)
                    <hr>
                    <h6>Rejected Reason</h6>
                    <p>{{ $document->rejected_reason }}</p>
                  @endif
                  <hr>
                  <small class="text-muted">Uploaded on {{ $document->created_at->format('d M Y') }}</small>
                  <span class="badge bg-label-secondary h-75"></span>
                </div>
              </div>
            </div>
          @empty
            <div class="accordion-item card">
              <div class="accordion-header p-1 d-flex justify-content-between show">
                <span class="badge bg-label-danger">Compliance Documents Not Uploaded Yet</span>
              </div>
            </div>
          @endforelse
        </div>
      </div>
    </div>
    @if ($company->requestedDocuments()->exists())
        <div class="card mt-2">
          <div class="card-header p-3 pb-0">
            <h5>Requested Documents</h5>
          </div>
          <div class="card-body d-flex px-3 pb-0">
            @foreach ($company->requestedDocuments as $document)
                @if ($loop->last)
                  <h6 class="mx-1">{{ $document->name }}</h6>
                @elseif ($loop->first)
                  <h6>{{ $document->name.', ' }}</h6>
                @else
                  <h6 class="mx-1">{{ $document->name.', ' }}</h6>
                @endif
            @endforeach
          </div>
        </div>
    @endif
  </div>
</div>
<!-- Examples -->

@endsection
