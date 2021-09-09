@extends('layouts.app')

@section('title', 'Edit Role')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@push('page_css')
    <style>
        .custom-control-label {
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('utils.alerts')
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Role <i class="bi bi-check"></i>
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Role Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" required value="{{ $role->name }}">
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="permissions">
                                    Permissions <span class="text-danger">*</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="select-all">
                                    <label class="custom-control-label" for="select-all">Give All Permissions</label>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Dashboard Permissions -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Dashboard
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_total_stats" name="permissions[]"
                                                               value="show_total_stats" {{ $role->hasPermissionTo('show_total_stats') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_total_stats">Total Stats</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_notifications" name="permissions[]"
                                                               value="show_notifications" {{ $role->hasPermissionTo('show_notifications') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_notifications">Notifications</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_month_overview" name="permissions[]"
                                                               value="show_month_overview" {{ $role->hasPermissionTo('show_month_overview') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_month_overview">Month Overview</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_weekly_sales_purchases" name="permissions[]"
                                                               value="show_weekly_sales_purchases" {{ $role->hasPermissionTo('show_weekly_sales_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_weekly_sales_purchases">Weekly Sales & Purchases</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_monthly_cashflow" name="permissions[]"
                                                               value="show_monthly_cashflow" {{ $role->hasPermissionTo('show_monthly_cashflow') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_monthly_cashflow">Monthly Cashflow</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- User Management Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            User Mangement
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_user_management" name="permissions[]"
                                                               value="access_user_management" {{ $role->hasPermissionTo('access_user_management') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_user_management">Access</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_own_profile" name="permissions[]"
                                                               value="edit_own_profile" {{ $role->hasPermissionTo('edit_own_profile') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_own_profile">Own Profile</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Products Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Products
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_products" name="permissions[]"
                                                               value="access_products" {{ $role->hasPermissionTo('access_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_products">Access</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_products" name="permissions[]"
                                                               value="show_products" {{ $role->hasPermissionTo('show_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_products">View</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_products" name="permissions[]"
                                                               value="create_products" {{ $role->hasPermissionTo('create_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_products">Create</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_products" name="permissions[]"
                                                               value="edit_products" {{ $role->hasPermissionTo('edit_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_products">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_products" name="permissions[]"
                                                               value="delete_products" {{ $role->hasPermissionTo('delete_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_products">Delete</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_product_categories" name="permissions[]"
                                                               value="access_product_categories" {{ $role->hasPermissionTo('access_product_categories') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_product_categories">Category</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="print_barcodes" name="permissions[]"
                                                               value="print_barcodes" {{ $role->hasPermissionTo('print_barcodes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="print_barcodes">Print Barcodes</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Adjustments Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Adjustments
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_adjustments" name="permissions[]"
                                                               value="access_adjustments" {{ $role->hasPermissionTo('access_adjustments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_adjustments">Access</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_adjustments" name="permissions[]"
                                                               value="create_adjustments" {{ $role->hasPermissionTo('create_adjustments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_adjustments">Create</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_adjustments" name="permissions[]"
                                                               value="show_adjustments" {{ $role->hasPermissionTo('show_adjustments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_adjustments">View</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_adjustments" name="permissions[]"
                                                               value="edit_adjustments" {{ $role->hasPermissionTo('edit_adjustments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_adjustments">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_adjustments" name="permissions[]"
                                                               value="delete_adjustments" {{ $role->hasPermissionTo('delete_adjustments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_adjustments">Delete</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quotations Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Quotaions
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_quotations" name="permissions[]"
                                                               value="access_quotations" {{ $role->hasPermissionTo('access_quotations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_quotations">Access</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_quotations" name="permissions[]"
                                                               value="create_quotations" {{ $role->hasPermissionTo('create_quotations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_quotations">Create</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_quotations" name="permissions[]"
                                                               value="show_quotations" {{ $role->hasPermissionTo('show_quotations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_quotations">View</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_quotations" name="permissions[]"
                                                               value="edit_quotations" {{ $role->hasPermissionTo('edit_quotations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_quotations">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_quotations" name="permissions[]"
                                                               value="delete_quotations" {{ $role->hasPermissionTo('delete_quotations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_quotations">Delete</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="send_quotation_mails" name="permissions[]"
                                                               value="send_quotation_mails" {{ $role->hasPermissionTo('send_quotation_mails') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="send_quotation_mails">Send Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_quotation_sales" name="permissions[]"
                                                               value="create_quotation_sales" {{ $role->hasPermissionTo('create_quotation_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_quotation_sales">Sale From Quotation</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Expenses Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Expenses
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_expenses" name="permissions[]"
                                                               value="access_expenses" {{ $role->hasPermissionTo('access_expenses') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_expenses">Access</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_expenses" name="permissions[]"
                                                               value="create_expenses" {{ $role->hasPermissionTo('create_expenses') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_expenses">Create</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_expenses" name="permissions[]"
                                                               value="edit_expenses" {{ $role->hasPermissionTo('edit_expenses') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_expenses">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_expenses" name="permissions[]"
                                                               value="delete_expenses" {{ $role->hasPermissionTo('delete_expenses') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_expenses">Delete</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_expense_categories" name="permissions[]"
                                                               value="access_expense_categories" {{ $role->hasPermissionTo('access_expense_categories') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_expense_categories">Category</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Customers Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Customers
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_customers" name="permissions[]"
                                                               value="access_customers" {{ $role->hasPermissionTo('access_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_customers">Access</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_customers" name="permissions[]"
                                                               value="create_customers" {{ $role->hasPermissionTo('create_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_customers">Create</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_customers" name="permissions[]"
                                                               value="show_customers" {{ $role->hasPermissionTo('show_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_customers">View</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_customers" name="permissions[]"
                                                               value="edit_customers" {{ $role->hasPermissionTo('edit_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_customers">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_customers" name="permissions[]"
                                                               value="delete_customers" {{ $role->hasPermissionTo('delete_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_customers">Delete</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Suppliers Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Suppliers
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_suppliers" name="permissions[]"
                                                               value="access_suppliers" {{ $role->hasPermissionTo('access_suppliers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_suppliers">Access</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_suppliers" name="permissions[]"
                                                               value="create_suppliers" {{ $role->hasPermissionTo('create_suppliers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_suppliers">Create</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_suppliers" name="permissions[]"
                                                               value="show_suppliers" {{ $role->hasPermissionTo('show_suppliers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_suppliers">View</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_suppliers" name="permissions[]"
                                                               value="edit_suppliers" {{ $role->hasPermissionTo('edit_suppliers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_suppliers">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_customers" name="permissions[]"
                                                               value="delete_customers" {{ $role->hasPermissionTo('delete_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_customers">Delete</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sales Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Sales
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_sales" name="permissions[]"
                                                               value="access_sales" {{ $role->hasPermissionTo('access_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_sales">Access</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_sales" name="permissions[]"
                                                               value="create_sales" {{ $role->hasPermissionTo('create_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_sales">Create</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_sales" name="permissions[]"
                                                               value="show_suppliers" {{ $role->hasPermissionTo('show_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_sales">View</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_sales" name="permissions[]"
                                                               value="edit_sales" {{ $role->hasPermissionTo('edit_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_sales">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_sales" name="permissions[]"
                                                               value="delete_sales" {{ $role->hasPermissionTo('delete_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_sales">Delete</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_pos_sales" name="permissions[]"
                                                               value="create_pos_sales" {{ $role->hasPermissionTo('create_pos_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_pos_sales">POS System</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_sale_payments" name="permissions[]"
                                                               value="access_sale_payments" {{ $role->hasPermissionTo('access_sale_payments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_sale_payments">Payments</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sale Returns Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Sale Returns
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_sale_returns" name="permissions[]"
                                                               value="access_sale_returns" {{ $role->hasPermissionTo('access_sale_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_sale_returns">Access</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_sale_returns" name="permissions[]"
                                                               value="create_sale_returns" {{ $role->hasPermissionTo('create_sale_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_sale_returns">Create</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_sale_returns" name="permissions[]"
                                                               value="show_sale_returns" {{ $role->hasPermissionTo('show_sale_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_sale_returns">View</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_sale_returns" name="permissions[]"
                                                               value="edit_sale_returns" {{ $role->hasPermissionTo('edit_sale_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_sale_returns">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_sale_returns" name="permissions[]"
                                                               value="delete_sale_returns" {{ $role->hasPermissionTo('delete_sale_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_sale_returns">Delete</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_sale_return_payments" name="permissions[]"
                                                               value="access_sale_return_payments" {{ $role->hasPermissionTo('access_sale_return_payments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_sale_return_payments">Payments</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Purchases Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Purchases
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_purchases" name="permissions[]"
                                                               value="access_purchases" {{ $role->hasPermissionTo('access_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_purchases">Access</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_purchases" name="permissions[]"
                                                               value="create_purchases" {{ $role->hasPermissionTo('create_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_purchases">Create</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_purchases" name="permissions[]"
                                                               value="show_purchases" {{ $role->hasPermissionTo('show_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_purchases">View</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_purchases" name="permissions[]"
                                                               value="edit_purchases" {{ $role->hasPermissionTo('edit_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_purchases">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_purchases" name="permissions[]"
                                                               value="delete_purchases" {{ $role->hasPermissionTo('delete_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_purchases">Delete</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_purchase_payments" name="permissions[]"
                                                               value="access_purchase_payments" {{ $role->hasPermissionTo('access_purchase_payments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_purchase_payments">Payments</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Purchases Returns Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Purchase Returns
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_purchase_returns" name="permissions[]"
                                                               value="access_purchase_returns" {{ $role->hasPermissionTo('access_purchase_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_purchase_returns">Access</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_purchase_returns" name="permissions[]"
                                                               value="create_purchase_returns" {{ $role->hasPermissionTo('create_purchase_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_purchase_returns">Create</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="show_purchase_returns" name="permissions[]"
                                                               value="show_purchase_returns" {{ $role->hasPermissionTo('show_purchase_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_purchase_returns">View</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_purchase_returns" name="permissions[]"
                                                               value="edit_purchase_returns" {{ $role->hasPermissionTo('edit_purchase_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_purchase_returns">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_purchase_returns" name="permissions[]"
                                                               value="delete_purchase_returns" {{ $role->hasPermissionTo('delete_purchase_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_purchase_returns">Delete</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_purchase_return_payments" name="permissions[]"
                                                               value="access_purchase_return_payments" {{ $role->hasPermissionTo('access_purchase_return_payments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_purchase_return_payments">Payments</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Currencies Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Currencies
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_currencies" name="permissions[]"
                                                               value="access_currencies" {{ $role->hasPermissionTo('access_currencies') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_currencies">Access</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="create_currencies" name="permissions[]"
                                                               value="create_currencies" {{ $role->hasPermissionTo('create_currencies') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_currencies">Create</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="edit_currencies" name="permissions[]"
                                                               value="edit_currencies" {{ $role->hasPermissionTo('edit_currencies') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_currencies">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete_currencies" name="permissions[]"
                                                               value="delete_currencies" {{ $role->hasPermissionTo('delete_currencies') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_currencies">Delete</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reports -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Reports
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_reports" name="permissions[]"
                                                               value="access_reports" {{ $role->hasPermissionTo('access_reports') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_reports">Access</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Settings -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Settings
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="access_settings" name="permissions[]"
                                                               value="access_settings" {{ $role->hasPermissionTo('access_settings') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_settings">Access</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('#select-all').click(function() {
                var checked = this.checked;
                $('input[type="checkbox"]').each(function() {
                    this.checked = checked;
                });
            })
        });
    </script>
@endpush
