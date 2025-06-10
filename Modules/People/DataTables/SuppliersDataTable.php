<?php

namespace Modules\People\DataTables;


use Modules\People\Entities\Supplier;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SuppliersDataTable extends DataTable
{

    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('people::suppliers.partials.actions', compact('data'));
            });
    }

    public function query(Supplier $model) {
        return $model->newQuery();
    }

    public function html() {
        return $this->builder()
            ->setTableId('suppliers-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                        'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(4)
            ->language([
                'url' => asset('js/i18n/' . app()->getLocale() . '.json')
            ])
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> ' . __('people::messages.print')),
                Button::make('reset')
                    ->text('<i class="bi bi-x-circle"></i> ' . __('people::messages.reset')),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> ' . __('people::messages.reload'))
            );
    }

    protected function getColumns() {
        return [
            Column::make('supplier_name')
                ->title(__('people::messages.supplier_name'))
                ->className('text-center align-middle'),

            Column::make('supplier_email')
                ->title(__('people::messages.supplier_email'))
                ->className('text-center align-middle'),

            Column::make('supplier_phone')
                ->title(__('people::messages.supplier_phone'))
                ->className('text-center align-middle'),

            Column::computed('action')
                ->title(__('people::messages.action'))
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename(): string {
        return 'Suppliers_' . date('YmdHis');
    }
}
