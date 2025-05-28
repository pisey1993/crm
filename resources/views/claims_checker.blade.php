@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-success"><i class="bi bi-check-circle me-2"></i> Claims Checker</h2>

        <!-- Search Form -->
        <form method="GET" action="/claims/checker" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="policy_number" class="form-control" placeholder="Enter Policy Number">
            </div>
            <div class="col-md-4">
                <input type="text" name="claim_id" class="form-control" placeholder="Enter Claim ID">
            </div>
            <div class="col-md-4 d-grid">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-search me-1"></i> Search
                </button>
            </div>
        </form>

        <!-- Claims Result Table -->
        @if(isset($claims) && count($claims))
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Claim Results</h5>
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                        <tr>
                            <th>Claim ID</th>
                            <th>Policy Number</th>
                            <th>Type</th>
                            <th>Date Filed</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($claims as $claim)
                            <tr>
                                <td>{{ $claim->id }}</td>
                                <td>{{ $claim->policy_number }}</td>
                                <td>{{ ucfirst($claim->type) }}</td>
                                <td>{{ \Carbon\Carbon::parse($claim->incident_date)->format('M d, Y') }}</td>
                                <td>
                                    @if($claim->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($claim->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif(request()->has('policy_number') || request()->has('claim_id'))
            <div class="alert alert-info mt-4">No claims found for your search.</div>
        @endif
    </div>
@endsection
