@extends('layouts.app')

@section('title', __('people::messages.customer_details'))

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">{{ __('people::messages.customers') }}</a></li>
        <li class="breadcrumb-item active">{{ __('people::messages.details') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>{{ __('people::messages.customer_name') }}</th>
                                    <td>{{ $customer->customer_name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('people::messages.customer_email') }}</th>
                                    <td>{{ $customer->customer_email }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('people::messages.customer_phone') }}</th>
                                    <td>{{ $customer->customer_phone }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('people::messages.city') }}</th>
                                    <td>{{ $customer->city }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('people::messages.country') }}</th>
                                    <td>{{ $customer->country }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('people::messages.address') }}</th>
                                    <td>{{ $customer->address }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

