<?php

namespace App\DataTables;

use Modules\Product\Entities\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
            ->addColumn('action', function ($data) {
                return view('product::categories.partials.actions', compact('data'));
            })
            ->addColumn('product_image', function ($data) {
                $url = asset('storage/product_images/' . $data->product_image);
                return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';
            })
            ->addColumn('category_name', function ($data) {
                return $data->category->category_name;
            });
    }


    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Product\Entities\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bflrtip')
                    ->orderBy(0)
                    ->buttons(
                        Button::make('excel'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
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
            Column::computed('product_image')
                ->title('Image')
                ->addClass('text-center'),

            Column::make('product_name')
                ->title('Name')
                ->addClass('text-center'),

            Column::make('product_code')
                ->title('Code')
                ->addClass('text-center'),

            Column::make('product_price')
                ->title('Price')
                ->addClass('text-center'),

            Column::make('product_unit')
                ->title('Unit')
                ->addClass('text-center'),

            Column::make('product_quantity')
                ->title('Quantity')
                ->addClass('text-center'),

            Column::computed('category_name')
                ->title('Category')
                ->addClass('text-center'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Product_' . date('YmdHis');
    }
}
