<?php

namespace Modules\Purchase\DataTables;

use Modules\Purchase\Entities\Purchase;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PurchaseDataTable extends DataTable
{

    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->addColumn('total_amount', function ($data) {
                return format_currency($data->total_amount);
            })
            ->addColumn('paid_amount', function ($data) {
                return format_currency($data->paid_amount);
            })
            ->addColumn('due_amount', function ($data) {
                return format_currency($data->due_amount);
            })
            ->addColumn('status', function ($data) {
                return view('purchase::partials.status', compact('data'));
            })
            ->addColumn('payment_status', function ($data) {
                return view('purchase::partials.payment-status', compact('data'));
            })
            ->addColumn('action', function ($data) {
                return view('purchase::partials.actions', compact('data'));
            });
    }

    public function query(Purchase $model) {
        return $model->newQuery();
    }

    public function html() {
        return $this->builder()
            ->setTableId('purchases-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(8)
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
            Column::make('reference')
                ->title(__('purchase::messages.reference'))
                ->className('text-center align-middle'),

            Column::make('supplier_name')
                ->title(__('purchase::messages.supplier'))
                ->className('text-center align-middle'),

            Column::computed('status')
                ->title(__('purchase::messages.status'))
                ->className('text-center align-middle'),

            Column::computed('total_amount')
                ->title(__('purchase::messages.total_amount'))
                ->className('text-center align-middle'),

            Column::computed('paid_amount')
                ->title(__('purchase::messages.paid_amount'))
                ->className('text-center align-middle'),

            Column::computed('due_amount')
                ->title(__('purchase::messages.due_amount'))
                ->className('text-center align-middle'),

            Column::computed('payment_status')
                ->title(__('purchase::messages.payment_status'))
                ->className('text-center align-middle'),

            Column::computed('action')
                ->title(__('purchase::messages.actions'))
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename(): string {
        return 'Purchase_' . date('YmdHis');
    }
}
