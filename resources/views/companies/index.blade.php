@extends('layout')

@section('title', 'Companies')

@section('content')

<div class="row">
    <div class="col-12">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Companies</h2>
            <a href="{{ route('companies.create') }}" class="btn btn-primary">+ Create Company</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th width="80">ID</th>
                                <th>Company Name</th>
                                <th width="220">Created At</th>
                                <th width="180" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($companies))
                            @foreach($companies as $company)
                                <tr>
                                    <td>{{ $company->id }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->created_at->format('d M Y h:i A') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('companies.edit', $company) }}" class="btn btn-warning btn-sm"> Edit </a>

                                        <form action="{{ route('companies.destroy', $company) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete Company?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <span class="text-muted">
                                            No Companies Found
                                        </span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $companies->links() }}
        </div>
    </div>
</div>

@endsection