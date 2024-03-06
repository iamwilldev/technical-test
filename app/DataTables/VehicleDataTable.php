<?php

namespace App\DataTables;

use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VehicleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Vehicle $vehiclee) {
                return view('dashboard.vehicle.vehicles.action', compact('vehiclee'));
            })
            ->rawColumns(['type', 'status'])
            ->editColumn('type', function (Vehicle $vehicle) {
                return $vehicle->type == 'Goods' ? 'Angkutan Barang' : 'Angkutan Orang';
            })
            ->editColumn('status', function (Vehicle $vehicle) {
                $diff = Carbon::now()->diffInDays(Carbon::parse($vehicle->service_schedule), false);

                if ($diff < 3) {
                    return '<span class="badge bg-danger">Service</span>';
                } elseif($vehicle->status == 'Active') {
                    return '<span class="badge bg-success">Active</span>';
                } elseif($vehicle->status == 'Nonaktif') {
                    return '<span class="badge bg-secondary">Nonaktif</span>';
                } elseif($vehicle->status == 'Service') {
                    return '<span class="badge bg-warning">Service</span>';
                }
            })
            ->editColumn('created_at', function (Vehicle $vehicle) {
                return $vehicle->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i:s T');
            })
            ->editColumn('updated_at', function (Vehicle $vehicle) {
                return $vehicle->updated_at->timezone('Asia/Jakarta')->format('d-m-Y H:i:s T');
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Vehicle $model): QueryBuilder
    {
        $query = $model->newQuery();

        $searchTerm = request()->input('search')['value'] ?? null;

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('type', 'like', '%' . $searchTerm . '%')
                    ->orWhere('registration_number', 'like', '%' . $searchTerm . '%')
                    ->orWhere('fuel_consumption', 'like', '%' . $searchTerm . '%')
                    ->orWhere('service_schedule', 'like', '%' . $searchTerm . '%')
                    ->orWhere('last_kilometer', 'like', '%' . $searchTerm . '%')
                    ->orWhere('status', 'like', '%' . $searchTerm . '%')
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
                    ->setTableId('vehicle-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax(route('dashboard.vehicle.vehicles.index'))
                    //->dom('Bfrtip')
                    ->parameters([
                        'searching' => false,
                    ])
                    ->initComplete('function(settings, json) {
                        var table = window.LaravelDataTables[\'vehicle-table\'];
                
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
                    ->orderBy(1)
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
            Column::computed('type')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Type'),
            Column::computed('status')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Status'),
            Column::make('registration_number'),
            Column::make('fuel_consumption'),
            Column::make('service_schedule'),
            Column::make('last_kilometer'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Vehicle_' . date('YmdHis');
    }
}
