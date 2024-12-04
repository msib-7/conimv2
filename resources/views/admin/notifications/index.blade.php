@extends('layouts.theme.master')
@section('title')
    Master Notifications
@endsection

{{-- @section('button')
    <div class="d-flex">
        <a href="#" class="btn btn-primary btn-nav"><i class="ti ti-help-alt me-1"></i>Get
            Support</a>
        <a href="#" class="btn btn-danger nav-icon ms-2"><i class="ti ti-info-circle"></i></a>
    </div>
@endsection --}}

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h5>Send Your Notifications</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.notify.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="users">Select Employee</label>
                            <select class="form-select" id="users" name="users">
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="exampleInputPassword1">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Title Notify">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" placeholder="Insert Your Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mb-4 w-100 mt-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
      <!-- [Page Specific JS] start -->
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard-default.js') }}"></script>
@endsection
