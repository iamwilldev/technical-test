<?php

namespace App\DataTables;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DriverDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Driver $driverr) {
                return view('dashboard.driver.drivers.action', compact('driverr'));
            })
            ->editColumn('created_at', function (Driver $driverr) {
                return $driverr->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i:s T');
            })
            ->editColumn('updated_at', function (Driver $driverr) {
                return $driverr->updated_at->timezone('Asia/Jakarta')->format('d-m-Y H:i:s T');
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Driver $model): QueryBuilder
    {
        $query = $model->newQuery();

        $searchTerm = request()->input('search')['value'] ?? null;

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%')
                    ->orWhere('address', 'like', '%' . $searchTerm . '%')
                    ->orWhere('created_at', 'like', '%' . $searchTerm . '%')
                    ->orWhere('updated_at', 'like', '%' . $searchTerm . '%');
            });
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('driver-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax(route('dashboard.driver.drivers.index'))
                    //->dom('Bfrtip')
                    ->parameters([
                        'searching' => false,
                    ])
                    ->initComplete('function(settings, json) {
                        var table = window.LaravelDataTables[\'driver-table\'];
                
                        $(\'#input-search\').on(\'keyup\', function() {
                            var searchTerm = $(this).val().toLowerCase();
                
                            table.rows().every(function() {
                                var row = this.node();
                                var rowText = row.textContent.toLowerCase();
                
                                if (rowText.indexOf(searchTerm) === -1) {
                                    $(row).hide();
                                } else {
                                    $(row).show();
                                }
                            });
                        });
                    }')
                    ->orderBy(5)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Action'),
            Column::make('name'),
            Column::make('email'),
            Column::make('address'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Driver_' . date('YmdHis');
    }
}
