<?php

namespace Modules\Purchase\DataTables;

use Modules\Purchase\Entities\PurchasePayment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PurchasePaymentsDataTable extends DataTable
{
    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->addColumn('amount', function ($data) {
                return format_currency($data->amount);
            })
            ->addColumn('action', function ($data) {
                return view('purchase::payments.partials.actions', compact('data'));
            });
    }

    public function query(PurchasePayment $model) {
        return $model->newQuery()->byPurchase()->with('purchase');
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
                    ->text('<i class="bi bi-printer-fill"></i> ' . __('purchase::messages.print')),
                Button::make('reset')
                    ->text('<i class="bi bi-x-circle"></i> ' . __('purchase::messages.reset')),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> ' . __('purchase::messages.reload'))
            );
    }

    protected function getColumns() {
        return [
            Column::make('date')
                ->title(__('purchase::messages.date'))
                ->className('align-middle text-center'),

            Column::make('reference')
                ->title(__('purchase::messages.reference'))
                ->className('align-middle text-center'),

            Column::computed('amount')
                ->title(__('purchase::messages.amount'))
                ->className('align-middle text-center'),

            Column::make('payment_method')
                ->title(__('purchase::messages.payment_method'))
                ->className('align-middle text-center'),

            Column::computed('action')
                ->title(__('purchase::messages.actions'))
                ->exportable(false)
                ->printable(false)
                ->className('align-middle text-center'),

            Column::make('created_at')
                ->visible(false),
        ];
    }

    protected function filename(): string {
        return 'PurchasePayments_' . date('YmdHis');
    }
}
