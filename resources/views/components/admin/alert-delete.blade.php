@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¡Esta acción no se puede deshacer!',
                    icon: 'warning',
                    background: '#1F1F1F',
                    color: '#FFFFFF',
                    iconColor: '#DC2626',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        popup: 'rounded-lg shadow-xl',
                        title: 'text-white text-xl font-semibold',
                        htmlContainer: 'text-white text-sm',
                        confirmButton: 'bg-white text-black hover:bg-[#E5E5E5] font-semibold px-5 py-2 rounded-md transition',
                        cancelButton: 'bg-[#2A2A2A] text-white hover:bg-[#3A3A3A] font-semibold px-5 py-2 rounded-md transition',
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
