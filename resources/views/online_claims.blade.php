@extends('layouts.app')

@section('content')
    <div class="container py-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>There were some problems with your input:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        @if (session('filepaths'))
            <div class="alert alert-info">
                <strong>Uploaded Files:</strong>
                <ul>
                    @foreach (session('filepaths') as $filepath)
                        <li>
                            <a href="{{ asset($filepath['filename']) }}" target="_blank">{{ basename($filepath['filename']) }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('claims.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="policy_number" class="form-label">Policy Number <span class="text-danger">*</span></label>
                <input type="text" name="policy_number" id="policy_number" class="form-control" value="{{ old('policy_number') }}" required>
            </div>

            <div class="mb-3">
                <label for="claim_type" class="form-label">Claim Type <span class="text-danger">*</span></label>
                <select name="claim_type" id="claim_type" class="form-select" required>
                    <option value="" disabled {{ old('claim_type') ? '' : 'selected' }}>Select claim type</option>
                    <option value="health" {{ old('claim_type') == 'health' ? 'selected' : '' }}>Health</option>
                    <option value="vehicle" {{ old('claim_type') == 'vehicle' ? 'selected' : '' }}>Vehicle</option>
                    <option value="property" {{ old('claim_type') == 'property' ? 'selected' : '' }}>Property</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="incident_date" class="form-label">Incident Date <span class="text-danger">*</span></label>
                <input type="date" name="incident_date" id="incident_date" class="form-control" value="{{ old('incident_date') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" id="description" rows="5" class="form-control" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="documents" class="form-label">Upload Documents <span class="text-danger">*</span></label>
                <input type="file" name="documents[]" id="documents" class="form-control" multiple accept=".jpg,.jpeg,.png,.pdf">
                <small class="form-text text-muted">Allowed file types: jpg, jpeg, png, pdf. Max size: 2MB each.</small>
            </div>

            <button type="submit" class="btn btn-primary">Submit Claim</button>
        </form>
    </div>
@endsection
