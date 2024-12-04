@extends('layouts.theme.master')

@section('title')
    Add Permission Manage
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5>@yield('title')</h5>
                    <p>
                        Manage Your Permission
                    </p>
                </div>
                <div class="card-body table-card">
                    <form action="{{ route('admin.permission.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="jobLvl" class="form-label">Job Level</label>
                            <input type="text" name="jobLvl" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select URLs</label>
                            <div class="form-check">
                                @foreach ($routes as $routeName => $route)
                                    <input type="checkbox" name="urls[]" value="{{ $routeName }}"
                                        class="form-check-input" id="route_{{ $loop->index }}">
                                    <label class="form-check-label"
                                        for="route_{{ $loop->index }}">{{ $routeName }}</label>
                                    <br>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
