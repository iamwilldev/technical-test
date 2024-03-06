@extends($layout)
@section('title', 'Kendaraan | ' . config('app.name'))

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
                        placeholder="Cari Kendaraan..." />
                    <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                </form>
            </div>
            <div class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                <a href="javascript:void(0)" class="btn btn-primary d-flex align-items-center btn-add" data-bs-toggle="modal"
                    data-bs-target="#modal"> <i class="ti ti-plus fs-5"></i> Tambah Kendaraan
                </a>
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
                                                <label for="inputType" class="form-label fw-semibold">Type</label>
                                                <select class="form-select" id="inputType" name="type" required>
                                                    <option value="Goods">Goods</option>
                                                    <option value="People">People</option>
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label for="inputRegistrationNumber" class="form-label fw-semibold">Registration Number</label>
                                                <input type="text" class="form-control" id="inputRegistrationNumber" name="registration_number" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="inputFuelConsumption" class="form-label fw-semibold">Fuel Consumption</label>
                                                <input type="text" class="form-control" id="inputFuelConsumption" name="fuel_consumption" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-stretch">
                                    <div class="card w-100 position-relative overflow-hidden">
                                        <div class="card-body p-4">
                                            <div class="mb-4">
                                                <label for="inputServiceSchedule" class="form-label fw-semibold">Service Schedule</label>
                                                <input type="date" class="form-control" id="inputServiceSchedule" name="service_schedule" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="inputLastKilometer" class="form-label fw-semibold">Last Kilometer</label>
                                                <input type="text" class="form-control" id="inputLastKilometer" name="last_kilometer" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="inputStatus" class="form-label fw-semibold">Status</label>
                                                <select class="form-select" id="inputStatus" name="status" required>
                                                    <option value="Active">Active</option>
                                                    <option value="Service">Service</option>
                                                    <option value="Nonaktif">Nonaktif</option>
                                                </select>
                                            </div>
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
        window.LaravelDataTables['vehicle-table'].draw(false);
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
        $('#brandForm select[type]').removeClass('is-invalid', 'is-valid');
        $('#brandForm input[registration_number]').removeClass('is-invalid', 'is-valid');
        $('#brandForm input[fuel_consumption]').removeClass('is-invalid', 'is-valid');
        $('#brandForm input[service_schedule]').removeClass('is-invalid', 'is-valid');
        $('#brandForm input[last_kilometer]').removeClass('is-invalid', 'is-valid');
        $('#brandForm select[status]').removeClass('is-invalid', 'is-valid');
    }

    $(document).ready(function() {
        modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modal'));
        $('.btn-add').click(function() {
            resetForm();
            $('#modalTitleId').text('Tambah Kendaraan');
            $('#detail-subtitle').text('Tambah detail kendaraan dibawah ini');
            
            $('#inputType').val('Goods').trigger('change');
            $('#inputRegistrationNumber').val('');
            $('#inputFuelConsumption').val('');
            $('#inputServiceSchedule').val('');
            $('#inputLastKilometer').val('');
            $('#inputStatus').val('Active').trigger('change');

            $('#brandForm').attr('action', route('dashboard.vehicle.vehicles.store'))
                .attr('method', 'POST');
        });
    });

    function onEdit(element) {
        resetForm();
        json = element.getAttribute('data-json');
        json = JSON.parse(json);
        $('#json-viewer').jsonViewer(json);
        $('#modalTitleId').text('Edit Kendaraan');
        $('#detail-subtitle').text('Edit detail kendaraan dibawah ini');

        // $('input[name="registration_number"]').prop('readonly', true);
        $('input[name="registration_number"]').val(json.registration_number).trigger('change');
        $('input[name="fuel_consumption"]').val(json.fuel_consumption).trigger('change');
        $('input[name="service_schedule"]').val(json.service_schedule).trigger('change');
        $('input[name="last_kilometer"]').val(json.last_kilometer).trigger('change');
        $('select[name="type"]').val(json.type).trigger('change');
        // ambil tanggal hari ini
        let today = new Date().toISOString().split('T')[0];
        // ambil tanggal service
        let service = json.service_schedule;

        // perbedaan hari
        let diff = Math.floor((Date.parse(service) - Date.parse(today)) / 86400000);

        // jika selisih hari kurang dari 3 hari 
        if (diff < 3) {
            $('select[name="status"]').val('Service').trigger('change');
        }

        $('select[name="status"]').val(json.status).trigger('change');

        $('#brandForm').attr('action', route('dashboard.vehicle.vehicles.update', json.id))
            .attr('method', 'PUT');
    }

    function onDelete(elemet) {
        json = element.getAttribute('data-json');
        json = JSON.parse(json);
        deleteForm(route('dashboard.vehicle.vehicles.destroy', json.id), reloadTable);
    }

</script>
@endpush
