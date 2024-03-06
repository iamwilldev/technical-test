@extends($layout)
@section('title', 'Pemesanan Kendaraan | ' . config('app.name'))

{{-- @push('css')
    <link rel="stylesheet" href="{{ asset('/') }}libs/prismjs/themes/prism-okaidia.min.css">
<link rel="stylesheet" href="{{ asset('/') }}libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
@endpush --}}

@section('content')

<div class="widget-content searchable-container list">
    <div class="card card-body">
        <div class="row">
            <div class="col-md-4 col-xl-3">
                <form class="position-relative" id="search-form">
                    <input type="text" class="form-control product-search ps-5" id="input-search" name="search"
                        placeholder="Cari Pemesanan..." />
                    <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                </form>
            </div>
            <div class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                @if(auth()->user()->hasRole('admin'))
                    <a href="javascript:void(0)" class="btn btn-primary d-flex align-items-center btn-add" data-bs-toggle="modal"
                        data-bs-target="#modal"> <i class="ti ti-plus fs-5"></i> Tambah Pemesanan
                    </a>
                @endif
            </div>
        </div>

    </div>

    <div class="card card-body">
        <div class="row">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" id="brandForm" novalidate enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="addEdit-brand-box">
                        <div class="addEdit-brand-content">
                            <div class="row">
                                <div class="col-lg-6 d-flex align-items-stretch">
                                    <div class="card w-100 position-relative overflow-hidden">
                                        <div class="card-body p-4">
                                            <h5 class="card-title fw-semibold">Detail</h5>
                                            <p class="card-subtitle mb-4" id="detail-subtitle"></p>
                                            <div class="mb-4">
                                                <label for="inputVehicle" class="form-label fw-semibold">Vehicle</label>
                                                <select class="form-select" id="inputVehicle" name="vehicle_id" required>
                                                    <option value="">Pilih Vehicle</option>
                                                    @foreach (\App\Models\Vehicle::where('status', 'Active')->get() as $vehicle)
                                                    <option value="{{ $vehicle->id }}">{{ $vehicle->registration_number.' ('.$vehicle->type.')' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label for="inputDriver" class="form-label fw-semibold">Driver</label>
                                                <select class="form-select" id="inputDriver" name="driver_id" required>
                                                    <option value="">Pilih Driver</option>
                                                    @foreach (\App\Models\Driver::all() as $driver)
                                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-stretch">
                                    <div class="card w-100 position-relative overflow-hidden">
                                        <div class="card-body p-4">
                                            <h5 class="card-title fw-semibold">Detail</h5>
                                            <p class="card-subtitle mb-4" id="detail-subtitle1"></p>
                                                <div class="mb-4" id="divApproval1">
                                                    <label for="inputApproval1" class="form-label fw-semibold">Approval 1</label>
                                                    <select class="form-select" id="inputApproval1" name="approvals[0][id]" required>
                                                        <option value="">Pilih Approval 1</option>
                                                        @foreach (\App\Models\User::whereHas('roles', function ($query) {
                                                            $query->where('name', 'approval1');
                                                        })->get() as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-4" id="divApprovalStatus1">
                                                    <label for="inputApprovalStatus1" class="form-label fw-semibold">Status</label>
                                                    <select class="form-select" id="inputApprovalStatus1" name="approvals[0][status]" required>
                                                        <option value="">Pilih Status</option>
                                                        <option value="pending">Pending</option>
                                                        <option value="approved">Approved</option>
                                                        <option value="rejected">Rejected</option>
                                                    </select>
                                                </div>
                                                <div class="mb-4" id="divApproval2">
                                                    <label for="inputApproval2" class="form-label fw-semibold">Approval 2</label>
                                                    <select class="form-select" id="inputApproval2" name="approvals[1][id]" required>
                                                        <option value="">Pilih Approval 2</option>
                                                        @foreach (\App\Models\User::whereHas('roles', function ($query) {
                                                            $query->where('name', 'approval2');
                                                        })->get() as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-4" id="divApprovalStatus2">
                                                    <label for="inputApprovalStatus2" class="form-label fw-semibold">Status</label>
                                                    <select class="form-select" id="inputApprovalStatus2" name="approvals[1][status]" required>
                                                        <option value="">Pilih Status</option>
                                                        <option value="pending">Pending</option>
                                                        <option value="approved">Approved</option>
                                                        <option value="rejected">Rejected</option>
                                                    </select>
                                                </div>
                                            {{-- tampilkan id booking saat modal update --}}
                                            <input type="hidden" id="id" name="id">
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="approval_status">
                                            <input type="hidden" name="approvals[0][id]" id="hiddenApprovalId1">
                                            <input type="hidden" name="approvals[1][id]" id="hiddenApprovalId2">
                                            <input type="hidden" name="approvals[0][status]" id="hiddenApprovalStatus1">
                                            <input type="hidden" name="approvals[1][status]" id="hiddenApprovalStatus2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" onclick="onSubmit()" class="btn btn-primary px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
{{ $dataTable->scripts() }}

<script>
    let modal = null;

    function reloadTable() {
        window.LaravelDataTables['booking-table'].draw(false);
    }

    function onCreated() {
        hideAddModal();
        reloadTable();
    }

    function hideAddModal() {
        $('#brandForm').trigger('reset');
        modal.hide();
    }

    $('#brandForm').submit(function(e) {
        e.preventDefault();
    });

    function onSubmit() {
        submitForm('#brandForm', onCreated);
    }

    function resetForm() {
        $('#brandForm').trigger('reset');
        $('#brandForm select').removeClass('is-invalid is-valid');
    }

    $(document).ready(function() {
        modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modal'));
        $('.btn-add').click(function() {
            resetForm();
            $('#modalTitleId').text('Tambah Pemesanan');
            $('#detail-subtitle').text('Tambah detail pemesanan dibawah ini');
            
            $('#inputVehicle, #inputDriver, #inputApproval1, #inputApproval2').val('');

            $('input[name="approval_status"]').val('pending').trigger('change');

            var userRoles = {!! json_encode(auth()->user()->roles->pluck('name')) !!};

            if (userRoles.includes('admin')) {
                $('#divApprovalStatus1, #divApprovalStatus2, #hiddenApprovalId1, #hiddenApprovalId2, #id').remove();
            }

            $('#brandForm').attr('action', route('dashboard.booking.bookings.store'))
                .attr('method', 'POST');
        });
    });

    function onEdit(element) {
        resetForm();
        var json = JSON.parse(element.getAttribute('data-json'));
        $('#json-viewer').jsonViewer(json);
        $('#modalTitleId').text('Edit Pemesanan');
        $('#detail-subtitle').text('Edit detail pemesanan dibawah ini');

        $('#inputVehicle').val(json.vehicle_id);
        $('#inputDriver').val(json.driver_id);
        $('#id').val(json.id);

        var userRoles = {!! json_encode(auth()->user()->roles->pluck('name')) !!};
        var approvalStatusCount = 0;
        if (userRoles.includes('admin')) {
            $('#divApprovalStatus1, #divApprovalStatus2, #hiddenApprovalId1, #hiddenApprovalId2').remove();
            $.each(JSON.parse(json.approvals), function(userId, userData) {
                var statusElement = $('#hiddenApprovalStatus' + (++approvalStatusCount));
                if (statusElement.length > 0) {
                    statusElement.val(userData.status);
                }
            });
        } else if (userRoles.includes('approval1')) {
            $('#divApproval2, #divApprovalStatus2, #hiddenApprovalStatus1, #hiddenApprovalId1').remove();
            $('#inputDriver, #inputVehicle').prop('disabled', true);
            $('#inputApproval1').prop('disabled', false);

            $.each(JSON.parse(json.approvals), function(index, approval) {
                $('#hiddenApprovalId' + (index + 1)).val(approval.id).trigger('change');
                $('#hiddenApprovalStatus' + (index + 1)).val(approval.status).trigger('change');
            });
        } else if (userRoles.includes('approval2')) {
            $('#divApproval1, #divApprovalStatus1, #hiddenApprovalStatus2, #hiddenApprovalId2').remove();
            $('#inputDriver, #inputVehicle').prop('disabled', true);
            $('#inputApproval2').prop('disabled', false);

            $.each(JSON.parse(json.approvals), function(index, approval) {
                $('#hiddenApprovalId' + (index + 1)).val(approval.id).trigger('change');
                $('#hiddenApprovalStatus' + (index + 1)).val(approval.status).trigger('change');
            });
        }

        $.each(JSON.parse(json.approvals), function(index, approval) {
            $('#inputApproval' + (index + 1)).val(approval.id).trigger('change');
            $('#inputApprovalStatus' + (index + 1)).val(approval.status).trigger('change');
        });

        $('input[name="approval_status"]').val(json.approval_status.toLowerCase()).trigger('change');

        $('#brandForm').attr('action', route('dashboard.booking.bookings.update', json.id))
            .attr('method', 'PUT');
    }

    function onDelete(element) {
        var json = JSON.parse(element.getAttribute('data-json'));
        deleteForm(route('dashboard.booking.bookings.destroy', json.id), reloadTable);
    }
</script>

@endpush
