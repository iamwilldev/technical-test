<div class="action-btn">
    <a href="javascript:void(0)" class="text-info edit" data-bs-toggle="modal" data-bs-target="#modal"
        data-json='{{ $activity->properties }}' onclick="onDetail()">
        <i class="ti ti-eye fs-5"></i>
    </a>
    {{-- <a href="javascript:void(0)" class="text-dark delete ms-2">
        <i class="ti ti-trash fs-5"></i>
    </a> --}}
</div>


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#json-viewer').jsonViewer({
                "agent": {
                    "ip": "127.0.0.1",
                    "browser": "Chrome",
                    "devices": "WebKit",
                    "location": "Unknown",
                    "platform": "Windows"
                }
            });
        });
        console.log('ready');
    </script>
@endpush
