<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('role', function ($data) {
                return view('user::users.partials.roles', [
                    'roles' => $data->getRoleNames()
                ]);
            })
            ->addColumn('action', function ($data) {
                return view('user::users.partials.actions', compact('data'));
            })
            ->addColumn('status', function ($data) {
                if ($data->is_active == 1) {
                    $html = '<span class="badge badge-success">Active</span>';
                } else {
                    $html = '<span class="badge badge-warning">Deactivated</span>';
                }
                return $html;
            })
            ->addColumn('image', function ($data) {
                $url = $data->getFirstMediaUrl('avatars');
                return '<img src="'.$url.'" style="width:50px;height:50px;" class="img-thumbnail rounded-circle"/>';
            })
            ->rawColumns(['image', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()
            ->with(['roles' => function ($query) {
                $query->select('name')->get();
            }])
            ->where('id', '!=', auth()->id());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
                    ->orderBy(1)
                    ->buttons(
                        Button::make('excel')
                            ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                        Button::make('print')
                            ->text('<i class="bi bi-printer-fill"></i> Print'),
                        Button::make('reset')
                            ->text('<i class="bi bi-x-circle"></i> Reset'),
                        Button::make('reload')
                            ->text('<i class="bi bi-arrow-repeat"></i> Reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('image')
                ->className('text-center align-middle'),

            Column::make('name')
                ->className('text-center align-middle'),

            Column::make('email')
                ->className('text-center align-middle'),

            Column::computed('role')
                ->className('text-center align-middle'),

            Column::computed('status')
                ->className('text-center align-middle'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
