@extends('layouts.app')

@section('title', 'Create Unit')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('units.index') }}">Units</a></li>
        <li class="breadcrumb-item active">Add</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('units.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Unit Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="short_name">Short Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="short_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="operator">Operator</label>
                                        <input type="text" class="form-control" name="operator" placeholder="ex: * / + -">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="operation_value">Operation Value</label>
                                        <input type="text" class="form-control" name="operation_value" placeholder="Enter a number">
                                    </div>
                                </div>
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <div class="form-group">
                                        <button class="btn btn-primary">Create Unit <i class="bi bi-check"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

