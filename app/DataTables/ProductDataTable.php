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
            ->eloquent($query)->with('category')
            ->addColumn('action', function ($data) {
                return view('product::products.partials.actions', compact('data'));
            })
            ->addColumn('product_image', function ($data) {
                $url = $data->getFirstMediaUrl();
                return '<img src="'.$url.'" border="0" width="50" class="img-thumbnail" align="center" />';
            })
            ->rawColumns(['product_image']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Product\Entities\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery()->with('category');
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
                ->addClass('text-center')
                ->addClass('align-middle'),

            Column::make('product_name')
                ->title('Name')
                ->addClass('text-center')
                ->addClass('align-middle'),

            Column::make('product_code')
                ->title('Code')
                ->addClass('text-center')
                ->addClass('align-middle'),

            Column::make('product_price')
                ->title('Price')
                ->addClass('text-center')
                ->addClass('align-middle'),

            Column::make('product_quantity')
                ->title('Quantity')
                ->addClass('text-center')
                ->addClass('align-middle'),

            Column::make('category.category_name')
                ->title('Category')
                ->addClass('text-center')
                ->addClass('align-middle'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->addClass('align-middle'),
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
