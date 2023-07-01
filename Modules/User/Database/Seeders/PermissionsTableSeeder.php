<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //User Mangement
            'edit_own_profile',
            'access_user_management',
            //Dashboard
            'show_total_stats',
            'show_month_overview',
            'show_weekly_sales_purchases',
            'show_monthly_cashflow',
            'show_notifications',
            //Products
            'access_products',
            'create_products',
            'show_products',
            'edit_products',
            'delete_products',
            //Product Categories
            'access_product_categories',
            //Barcode Printing
            'print_barcodes',
            //Adjustments
            'access_adjustments',
            'create_adjustments',
            'show_adjustments',
            'edit_adjustments',
            'delete_adjustments',
            //Quotaions
            'access_quotations',
            'create_quotations',
            'show_quotations',
            'edit_quotations',
            'delete_quotations',
            //Create Sale From Quotation
            'create_quotation_sales',
            //Send Quotation On Email
            'send_quotation_mails',
            //Expenses
            'access_expenses',
            'create_expenses',
            'edit_expenses',
            'delete_expenses',
            //Expense Categories
            'access_expense_categories',
            //Customers
            'access_customers',
            'create_customers',
            'show_customers',
            'edit_customers',
            'delete_customers',
            //Suppliers
            'access_suppliers',
            'create_suppliers',
            'show_suppliers',
            'edit_suppliers',
            'delete_suppliers',
            //Sales
            'access_sales',
            'create_sales',
            'show_sales',
            'edit_sales',
            'delete_sales',
            //POS Sale
            'create_pos_sales',
            //Sale Payments
            'access_sale_payments',
            //Sale Returns
            'access_sale_returns',
            'create_sale_returns',
            'show_sale_returns',
            'edit_sale_returns',
            'delete_sale_returns',
            //Sale Return Payments
            'access_sale_return_payments',
            //Purchases
            'access_purchases',
            'create_purchases',
            'show_purchases',
            'edit_purchases',
            'delete_purchases',
            //Purchase Payments
            'access_purchase_payments',
            //Purchase Returns
            'access_purchase_returns',
            'create_purchase_returns',
            'show_purchase_returns',
            'edit_purchase_returns',
            'delete_purchase_returns',
            //Purchase Return Payments
            'access_purchase_return_payments',
            //Reports
            'access_reports',
            //Currencies
            'access_currencies',
            'create_currencies',
            'edit_currencies',
            'delete_currencies',
            //Settings
            'access_settings',
            //Units
            'access_units'
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $role = Role::create([
            'name' => 'Admin'
        ]);

        $role->givePermissionTo($permissions);
        $role->revokePermissionTo('access_user_management');
    }
}
