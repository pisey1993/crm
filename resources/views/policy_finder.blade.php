@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-primary"><i class="bi bi-search me-2"></i> Policy Finder</h2>

        <!-- Search Form -->
        <form method="GET" action="/policies/finder" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="policy_number" class="form-control" placeholder="Policy Number">
            </div>
            <div class="col-md-4">
                <input type="text" name="full_name" class="form-control" placeholder="Full Name">
            </div>
            <div class="col-md-4">
                <input type="text" name="national_id" class="form-control" placeholder="National ID / Passport">
            </div>
            <div class="col-12 d-grid d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i> Search
                </button>
            </div>
        </form>

        <!-- Policy Results Table -->
        @if(isset($policies) && count($policies))
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Policy Results</h5>
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                        <tr>
                            <th>Policy Number</th>
                            <th>Holder Name</th>
                            <th>Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($policies as $policy)
                            <tr>
                                <td>{{ $policy->policy_number }}</td>
                                <td>{{ $policy->holder_name }}</td>
                                <td>{{ ucfirst($policy->type) }}</td>
                                <td>{{ \Carbon\Carbon::parse($policy->start_date)->format('M d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($policy->end_date)->format('M d, Y') }}</td>
                                <td>
                                    @if($policy->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @elseif($policy->status == 'expired')
                                        <span class="badge bg-secondary">Expired</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif(request()->has('policy_number') || request()->has('full_name') || request()->has('national_id'))
            <div class="alert alert-info mt-4">No policies found for your search criteria.</div>
        @endif
    </div>
@endsection
