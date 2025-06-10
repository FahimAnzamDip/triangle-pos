<?php

namespace Modules\User\DataTables;

use Spatie\Permission\Models\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
{

    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('user::roles.partials.actions', compact('data'));
            })
            ->addColumn('permissions', function ($data) {
                return view('user::roles.partials.permissions', [
                    'data' => $data
                ]);
            });

    }

    public function query(Role $model) {
        return $model->newQuery()->with(['permissions' => function ($query) {
            $query->select('name')->take(10)->get();
        }])->where('name', '!=', 'Super Admin');
    }

    public function html() {
        return $this->builder()
            ->setTableId('roles-table')
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
                    ->text('<i class="bi bi-printer-fill"></i> ' . __('user::messages.print')),
                Button::make('reset')
                    ->text('<i class="bi bi-x-circle"></i> ' . __('user::messages.reset')),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> ' . __('user::messages.reload'))
            );
    }

    protected function getColumns() {
        return [
            Column::make('id')
                ->title(__('user::messages.id'))
                ->addClass('text-center')
                ->addClass('align-middle'),

            Column::make('name')
                ->title(__('user::messages.name'))
                ->addClass('text-center')
                ->addClass('align-middle'),

            Column::computed('permissions')
                ->title(__('user::messages.permissions'))
                ->addClass('text-center')
                ->addClass('align-middle')
                ->width('700px'),

            Column::computed('action')
                ->title(__('user::messages.action'))
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->addClass('align-middle'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename(): string {
        return 'Roles_' . date('YmdHis');
    }
}
