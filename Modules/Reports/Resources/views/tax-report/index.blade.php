@extends('layouts.app')

@section('title', 'Tax Report - XML Export')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sales-report.index') }}">Reports</a></li>
        <li class="breadcrumb-item active">Tax Report</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-file-earmark-code"></i> Tax Report XML Export
                            </h5>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{ route('tax-report.export') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="month" class="form-label">Tax Period Month <span class="text-danger">*</span></label>
                                        <select name="month" id="month" class="form-control @error('month') is-invalid @enderror" required>
                                            <option value="">Select Month</option>
                                            <option value="1" {{ old('month') == '1' ? 'selected' : '' }}>January</option>
                                            <option value="2" {{ old('month') == '2' ? 'selected' : '' }}>February</option>
                                            <option value="3" {{ old('month') == '3' ? 'selected' : '' }}>March</option>
                                            <option value="4" {{ old('month') == '4' ? 'selected' : '' }}>April</option>
                                            <option value="5" {{ old('month') == '5' ? 'selected' : '' }}>May</option>
                                            <option value="6" {{ old('month') == '6' ? 'selected' : '' }}>June</option>
                                            <option value="7" {{ old('month') == '7' ? 'selected' : '' }}>July</option>
                                            <option value="8" {{ old('month') == '8' ? 'selected' : '' }}>August</option>
                                            <option value="9" {{ old('month') == '9' ? 'selected' : '' }}>September</option>
                                            <option value="10" {{ old('month') == '10' ? 'selected' : '' }}>October</option>
                                            <option value="11" {{ old('month') == '11' ? 'selected' : '' }}>November</option>
                                            <option value="12" {{ old('month') == '12' ? 'selected' : '' }}>December</option>
                                        </select>
                                        @error('month')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="year" class="form-label">Tax Period Year <span class="text-danger">*</span></label>
                                        <input type="number" 
                                               name="year" 
                                               id="year" 
                                               class="form-control @error('year') is-invalid @enderror" 
                                               value="{{ old('year', date('Y')) }}" 
                                               min="2020" 
                                               max="2030" 
                                               required>
                                        @error('year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-download"></i> Export XML
                                    </button>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <div class="card bg-light border-0">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="bi bi-info-circle"></i> Export Information
                                        </h6>
                                        <ul class="list-unstyled mb-0">
                                            <li><i class="bi bi-check-circle text-success"></i> Exports all completed sales for the selected month and year</li>
                                            <li><i class="bi bi-check-circle text-success"></i> Generates XML file in RetailInvoiceBulk format</li>
                                            <li><i class="bi bi-check-circle text-success"></i> Each sale becomes one RetailInvoice entry</li>
                                            <li><i class="bi bi-check-circle text-success"></i> Calculates tax amounts automatically (10% + 11%)</li>
                                            <li><i class="bi bi-check-circle text-success"></i> Sequential numbering for all invoices</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 