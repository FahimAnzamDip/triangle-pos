<?php

namespace Modules\Sale\DataTables;

use Modules\Sale\Entities\SalePayment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SalePaymentsDataTable extends DataTable
{

    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->addColumn('amount', function ($data) {
                return format_currency($data->amount);
            })
            ->addColumn('action', function ($data) {
                return view('sale::payments.partials.actions', compact('data'));
            });
    }

    public function query(SalePayment $model) {
        return $model->newQuery()->bySale()->with('sale');
    }

    public function html() {
        return $this->builder()
            ->setTableId('sale-payments-table')
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
                    ->text('<i class="bi bi-printer-fill"></i> ' . __('sale::messages.print')),
                Button::make('reset')
                    ->text('<i class="bi bi-x-circle"></i> ' . __('sale::messages.reset')),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> ' . __('sale::messages.reload'))
            );
    }

    protected function getColumns() {
        return [
            Column::make('date')
                ->title(__('sale::messages.date'))
                ->className('align-middle text-center'),

            Column::make('reference')
                ->title(__('sale::messages.reference'))
                ->className('align-middle text-center'),

            Column::computed('amount')
                ->title(__('sale::messages.amount'))
                ->className('align-middle text-center'),

            Column::make('payment_method')
                ->title(__('sale::messages.payment_method'))
                ->className('align-middle text-center'),

            Column::computed('action')
                ->title(__('sale::messages.action'))
                ->exportable(false)
                ->printable(false)
                ->className('align-middle text-center'),

            Column::make('created_at')
                ->visible(false),
        ];
    }

    protected function filename(): string {
        return 'SalePayments_' . date('YmdHis');
    }
}
