@extends('layouts.app')

@section('title', __('product::messages.print_barcode'))

@push('page_css')
    @livewireStyles
@endpush

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('product::messages.print_barcode') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <livewire:search-product/>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="alert alert-info">
                    <strong>{{ __('product::messages.barcode_note') }}</strong>
                </div>
            </div>
            <div class="col-md-12">
                <livewire:barcode.product-table/>
            </div>
        </div>
    </div>
@endsection
