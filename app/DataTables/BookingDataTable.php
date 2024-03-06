<?php

namespace App\DataTables;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BookingDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function (Booking $bokingg) {
            return view('dashboard.booking.bookings.action', compact('bokingg'));
        })
        ->rawColumns(['user_id', 'vehicle_id', 'driver_id', 'approvals', 'approval_status'])
        ->editColumn('user_id', function (Booking $bokingg) {
            return User::where('id', $bokingg->user_id)->first()->name;
        })
        ->editColumn('vehicle_id', function (Booking $bokingg) {
            return Vehicle::where('id', $bokingg->vehicle_id)->first()->registration_number . ' - ' . Vehicle::where('id', $bokingg->vehicle_id)->first()->brand . ' ' . Vehicle::where('id', $bokingg->vehicle_id)->first()->type;
        })
        ->editColumn('driver_id', function (Booking $bokingg) {
            return Driver::where('id', $bokingg->driver_id)->first()->name;
        })
        ->editColumn('approvals', function (Booking $bokingg) {
            $approvals = json_decode($bokingg->approvals, true);
            $modifiedApprovals = collect($approvals)->map(function ($approval) {
                return User::where('id', $approval['id'])->first()->name . ' (' . $approval['status'].')';
            })->implode(', ');

    return $modifiedApprovals;
        })
        ->editColumn('approval_status', function (Booking $bokingg) {
            $approvals = json_decode($bokingg->approvals, true);
            $status = 'Pending';
            foreach ($approvals as $userId => $approval) {
                if ($approval['status'] == 'rejected') {
                    $status = 'Rejected';
                    break;
                } elseif ($approval['status'] == 'pending') {
                    $status = 'Pending';
                } else {
                    $status = 'Approved';
                }
            }
            if ($status == 'Approved') {
                return '<span class="badge bg-success">Approved</span>';
            } elseif ($status == 'Rejected') {
                return '<span class="badge bg-danger">Rejected</span>';
            } else {
                return '<span class="badge bg-warning">Pending</span>';
            }
        })
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Booking $model): QueryBuilder
    {
        $query = $model->newQuery();

        $searchTerm = request()->input('search')['value'] ?? null;

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('user', 'like', '%' . $searchTerm . '%')
                    ->orWhere('vehicle', 'like', '%' . $searchTerm . '%')
                    ->orWhere('driver', 'like', '%' . $searchTerm . '%')
                    ->orWhere('approvals', 'like', '%' . $searchTerm . '%')
                    ->orWhere('approval_status', 'like', '%' . $searchTerm . '%')
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
                    ->setTableId('booking-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax(route('dashboard.booking.bookings.index'))
                    //->dom('Bfrtip')
                    ->parameters([
                        'searching' => false,
                    ])
                    ->initComplete('function(settings, json) {
                        var table = window.LaravelDataTables[\'booking-table\'];
                
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
                    ->orderBy(7)
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
            Column::computed('user_id')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('User'),
            Column::computed('vehicle_id')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center')
                ->title('Vehicle'),
            Column::computed('driver_id')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center')
                ->title('Driver'),
            Column::computed('approvals')
                ->exportable(false)
                ->printable(false)
                ->width(600)
                ->addClass('text-center')
                ->title('Approvals'),
            Column::computed('approval_status')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Status'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Booking_' . date('YmdHis');
    }
}
