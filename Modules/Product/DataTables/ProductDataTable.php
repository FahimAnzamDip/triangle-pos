<?php

namespace Modules\Product\DataTables;

use Modules\Product\Entities\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)->with('category')
            ->addColumn('action', function ($data) {
                return view('product::products.partials.actions', compact('data'));
            })
            ->addColumn('product_image', function ($data) {
                $url = $data->getFirstMediaUrl('images', 'thumb');
                return '<img src="'.$url.'" border="0" width="50" class="img-thumbnail" align="center"/>';
            })
            ->addColumn('product_price', function ($data) {
                return format_currency($data->product_price);
            })
            ->addColumn('product_cost', function ($data) {
                return format_currency($data->product_cost);
            })
            ->addColumn('product_quantity', function ($data) {
                return $data->product_quantity . ' ' . $data->product_unit;
            })
            ->rawColumns(['product_image']);
    }

    public function query(Product $model)
    {
        return $model->newQuery()->with('category');
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
                    ->orderBy(7)
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

    protected function getColumns()
    {
        return [
            Column::computed('product_image')
                ->title('Image')
                ->className('text-center align-middle'),

            Column::make('category.category_name')
                ->title('Category')
                ->className('text-center align-middle'),

            Column::make('product_code')
                ->title('Code')
                ->className('text-center align-middle'),

            Column::make('product_name')
                ->title('Name')
                ->className('text-center align-middle'),

            Column::computed('product_cost')
                ->title('Cost')
                ->className('text-center align-middle'),

            Column::computed('product_price')
                ->title('Price')
                ->className('text-center align-middle'),

            Column::computed('product_quantity')
                ->title('Quantity')
                ->className('text-center align-middle'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
