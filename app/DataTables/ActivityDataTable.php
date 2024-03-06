<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ActivityDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Activity $activity) {
                return view('dashboard.logs.activity.action', compact('activity'));
            })
            ->editColumn('created_at', function (Activity $activity) {
                return $activity->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i:s T');
            })
            ->editColumn('updated_at', function (Activity $activity) {
                return $activity->updated_at->timezone('Asia/Jakarta')->format('d-m-Y H:i:s T');
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Activity $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('activity-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(6)
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
                ->title('Aksi'),
            Column::make('log_name')
                ->title('Nama Log'),
            Column::make('description')
                ->title('Deskripsi'),
            Column::make('subject_type')
                ->title('Tipe Subjek'),
            Column::make('causer_type')
                ->title('Tipe Penyebab'),
            Column::make('created_at')
                ->title('Dibuat'),
            Column::make('updated_at')
                ->title('Diubah'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Activity_' . date('YmdHis');
    }
}
