{{-- Check the session --}}
@if(session('success-alert'))
    <script>
        toastr.success('{{ session("success-alert")["message"] }}');
    </script>
@endif

@if(session('error-alert'))
    <script>
        toastr.error('{{ session("failed-alert")["message"] }}');
    </script>
@endif
