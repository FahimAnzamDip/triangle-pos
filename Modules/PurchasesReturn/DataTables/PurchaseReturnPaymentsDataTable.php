<?php

namespace Modules\PurchasesReturn\DataTables;

use Modules\PurchasesReturn\Entities\PurchaseReturnPayment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PurchaseReturnPaymentsDataTable extends DataTable
{

    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->addColumn('amount', function ($data) {
                return format_currency($data->amount);
            })
            ->addColumn('action', function ($data) {
                return view('purchasesreturn::payments.partials.actions', compact('data'));
            });
    }

    public function query(PurchaseReturnPayment $model) {
        return $model->newQuery()->byPurchaseReturn()->with('purchaseReturn');
    }

    public function html() {
        return $this->builder()
            ->setTableId('purchase-payments-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(5)
            ->language([
                'url' => asset('js/i18n/' . app()->getLocale() . '.json')
            ])
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> ' . __('purchasesreturn::messages.print')),
                Button::make('reset')
                    ->text('<i class="bi bi-x-circle"></i> ' . __('purchasesreturn::messages.reset')),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> ' . __('purchasesreturn::messages.reload'))
            );
    }

    protected function getColumns() {
        return [
            Column::make('date')
                ->title(__('purchasesreturn::messages.date'))
                ->className('align-middle text-center'),

            Column::make('reference')
                ->title(__('purchasesreturn::messages.reference'))
                ->className('align-middle text-center'),

            Column::computed('amount')
                ->title(__('purchasesreturn::messages.amount'))
                ->className('align-middle text-center'),

            Column::make('payment_method')
                ->title(__('purchasesreturn::messages.payment_method'))
                ->className('align-middle text-center'),

            Column::computed('action')
                ->title(__('purchasesreturn::messages.action'))
                ->exportable(false)
                ->printable(false)
                ->className('align-middle text-center'),

            Column::make('created_at')
                ->visible(false),
        ];
    }

    protected function filename(): string {
        return 'PurchaseReturnPayments_' . date('YmdHis');
    }
}
