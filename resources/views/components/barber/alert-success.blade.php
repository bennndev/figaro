@if (session('message'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('message') }}',
            background: '#1F1F1F',
            color: '#FFFFFF',
            confirmButtonColor: '#3B82F6',
            confirmButtonText: 'OK',
            customClass: {
                popup: 'rounded-lg shadow-xl',
                title: 'text-white text-xl font-semibold',
                htmlContainer: 'text-white text-sm',
                confirmButton: 'bg-white text-black hover:bg-gray-200 font-semibold px-5 py-2 rounded-md transition'
            },
            buttonsStyling: false
        });
    </script>
@endif
