<?php

namespace Modules\Expense\DataTables;

use Modules\Expense\Entities\ExpenseCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExpenseCategoriesDataTable extends DataTable
{

    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('expense::categories.partials.actions', compact('data'));
            });
    }

    public function query(ExpenseCategory $model) {
        return $model->newQuery()->withCount('expenses');
    }

    public function html() {
        return $this->builder()
            ->setTableId('expensecategories-table')
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
                    ->text('<i class="bi bi-printer-fill"></i> ' . __('expense::messages.print')),
                Button::make('reset')
                    ->text('<i class="bi bi-x-circle"></i> ' . __('expense::messages.reset')),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> ' . __('expense::messages.reload'))
            );
    }

    protected function getColumns() {
        return [
            Column::make('category_name')
                ->title(__('expense::messages.category_name'))
                ->addClass('text-center'),

            Column::make('category_description')
                ->title(__('expense::messages.description'))
                ->addClass('text-center'),

            Column::make('expenses_count')
                ->title(__('expense::messages.expenses_count'))
                ->addClass('text-center'),

            Column::computed('action')
                ->title(__('expense::messages.action'))
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename(): string {
        return 'ExpenseCategories_' . date('YmdHis');
    }
}
