@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Fabric</h2>

    <form action="{{ route('fabrics.update', $fabric->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Fabric No --}}
        <div class="mb-3">
            <label for="fabric_no" class="form-label">Fabric No *</label>
            <input type="text" name="fabric_no" class="form-control"
                   value="{{ old('fabric_no', $fabric->fabric_no) }}" required>
        </div>

        {{-- Composition --}}
        <div class="mb-3">
            <label for="composition" class="form-label">Composition *</label>
            <input type="text" name="composition" class="form-control"
                   value="{{ old('composition', $fabric->composition) }}" required>
        </div>

        {{-- GSM --}}
        <div class="mb-3">
            <label for="gsm" class="form-label">GSM *</label>
            <input type="number" name="gsm" class="form-control"
                   value="{{ old('gsm', $fabric->gsm) }}" required>
        </div>

        {{-- Qty --}}
        <div class="mb-3">
            <label for="qty" class="form-label">QTY *</label>
            <input type="number" name="qty" class="form-control"
                   value="{{ old('qty', $fabric->qty) }}" required>
        </div>

        {{-- Cuttable Width --}}
        <div class="mb-3">
            <label for="cuttable_width" class="form-label">Cuttable Width *</label>
            <input type="text" name="cuttable_width" class="form-control"
                   value="{{ old('cuttable_width', $fabric->cuttable_width) }}" required>
        </div>

        {{-- Production Type --}}
        <div class="mb-3">
            <label for="production_type" class="form-label">Production Type *</label>
            <select name="production_type" class="form-select" required>
                <option value="Sample Yardage" {{ $fabric->production_type == 'Sample Yardage' ? 'selected' : '' }}>Sample Yardage</option>
                <option value="SMS" {{ $fabric->production_type == 'SMS' ? 'selected' : '' }}>SMS</option>
                <option value="Bulk" {{ $fabric->production_type == 'Bulk' ? 'selected' : '' }}>Bulk</option>
            </select>
        </div>

        {{-- Optional fields --}}
        <div class="mb-3">
            <label for="construction" class="form-label">Construction</label>
            <input type="text" name="construction" class="form-control"
                   value="{{ old('construction', $fabric->construction) }}">
        </div>

        <div class="mb-3">
            <label for="pantone_code" class="form-label">Pantone Code</label>
            <input type="text" name="pantone_code" class="form-control"
                   value="{{ old('pantone_code', $fabric->pantone_code) }}">
        </div>

        <div class="mb-3">
            <label for="weave_type" class="form-label">Weave Type</label>
            <input type="text" name="weave_type" class="form-control"
                   value="{{ old('weave_type', $fabric->weave_type) }}">
        </div>

        <div class="mb-3">
            <label for="finish_type" class="form-label">Finish Type</label>
            <input type="text" name="finish_type" class="form-control"
                   value="{{ old('finish_type', $fabric->finish_type) }}">
        </div>

        <div class="mb-3">
            <label for="dyeing_method" class="form-label">Dyeing Method</label>
            <input type="text" name="dyeing_method" class="form-control"
                   value="{{ old('dyeing_method', $fabric->dyeing_method) }}">
        </div>

        <div class="mb-3">
            <label for="printing_method" class="form-label">Printing Method</label>
            <input type="text" name="printing_method" class="form-control"
                   value="{{ old('printing_method', $fabric->printing_method) }}">
        </div>

        <div class="mb-3">
            <label for="lead_time" class="form-label">Lead Time</label>
            <input type="text" name="lead_time" class="form-control"
                   value="{{ old('lead_time', $fabric->lead_time) }}">
        </div>

        <div class="mb-3">
            <label for="moq" class="form-label">MOQ</label>
            <input type="number" name="moq" class="form-control"
                   value="{{ old('moq', $fabric->moq) }}">
        </div>

        <div class="mb-3">
            <label for="shrinkage" class="form-label">Shrinkage (%)</label>
            <input type="number" step="0.01" name="shrinkage" class="form-control"
                   value="{{ old('shrinkage', $fabric->shrinkage) }}">
        </div>

        <div class="mb-3">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea name="remarks" class="form-control">{{ old('remarks', $fabric->remarks) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="fabric_selected_by" class="form-label">Fabric Selected By</label>
            <input type="text" name="fabric_selected_by" class="form-control"
                   value="{{ old('fabric_selected_by', $fabric->fabric_selected_by) }}">
        </div>

        {{-- Image Upload --}}
        <div class="mb-3">
            <label for="image" class="form-label">Fabric Image</label><br>
            @if($fabric->image_path)
                <img src="{{ asset('storage/'.$fabric->image_path) }}" alt="fabric image" width="120" class="mb-2">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Fabric</button>
        <a href="{{ route('fabrics.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
