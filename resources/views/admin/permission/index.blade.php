@extends('layouts.theme.master')

@section('title')
    Permission Manage
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5>@yield('title')</h5>
                    <p>
                        Manage Your Category Corp
                    </p>
                </div>
                <div class="card-body table-card">
                    <div class="dt-responsive table-responsive">
                        <table id="footer-select" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Job Level</th>
                                    <th>Allowed URLs</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            {{ count($item->permission) }} Url Access
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.permission.show', $item->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form action="{{ route('admin.permission.destroy', $item->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
