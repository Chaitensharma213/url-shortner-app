@extends('layout')

@section('title', 'Invitations')

@section('content')

<div class="row">
    <div class="col-12">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Invitations</h2>

            <a href="{{ route('invitations.create') }}" class="btn btn-primary">
                + Invite New User
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th width="150">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($invitations))
                        @foreach($invitations as $invitation)
                            <tr>
                                <td>{{ $invitation->name }}</td>
                                <td>{{ $invitation->email }}</td>
                                <td>{{ $invitation->role->name }}</td>
                                <td>
                                @if($invitation->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($invitation->status == 'accepted')
                                    <span class="badge bg-success">Accepted</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($invitation->status) }}</span>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <span class="text-muted">
                                        No invitations found.
                                    </span>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection