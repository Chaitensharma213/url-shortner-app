@extends('layout')

@section('title', 'Short URLs')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Short URL List</h2>

            @if(auth()->user()->role_id != 1)
                <a href="{{ route('short-urls.create') }}" class="btn btn-primary">
                    + Create New Short URL
                </a>
            @endif
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th width="70">S.No</th>
                                <th>Title</th>
                                <th>Original URL</th>
                                <th>Short Code</th>
                                <th>Company</th>
                                <th>Created By</th>
                                <th width="170">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($shortUrls))
                            @foreach($shortUrls as $url)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $url->title }}</td>
                                <td>
                                    <a href="{{ $url->original_url }}" target="_blank" class="text-decoration-none">{{ $url->original_url }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('short-urls.redirect_url', $url->short_code) }}" target="_blank" class="badge bg-primary text-decoration-none">{{ $url->short_code }}</a>
                                </td>
                                <td>{{ $url->company->name ?? '-' }}</td>
                                <td>{{ $url->user->name ?? '-' }}</td>
                                <td>{{ $url->created_at->format('d M Y h:i A') }}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <span class="text-muted">
                                        No Short URLs Found
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
            {{ $shortUrls->links() }}
        </div>
    </div>
</div>

@endsection