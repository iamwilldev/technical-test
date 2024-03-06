@extends($layout)
@section('title', 'Log Activity | ' . config('app.name'))

{{-- @push('css')
    <link rel="stylesheet" href="{{ asset('/') }}libs/prismjs/themes/prism-okaidia.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
@endpush --}}

@section('content')

    <div class="card card-body">
        <div class="row">
            <div class="col-lg-12">
                {{-- add button --}}
                {{-- <div class="d-flex align-items-center justify-content-between pb-7">
                        <a href="{{ route('users.index') }}"
                            class="btn btn-primary btn-sm d-flex align-items-center justify-content-center">
                            <i class="ti ti-plus fs-4 me-2"></i> Created data
                        </a>
                    </div> --}}
                <div class="table-responsive">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">
                        Detail Log Activity
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <pre id="json-viewer">
                    </pre>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
@push('scripts')
    <script>
        function onDetail() {
            let target = $(event.target).parent();
            json = target.data('json');
            $('#json-viewer').jsonViewer(json);
        }
    </script>
@endpush
