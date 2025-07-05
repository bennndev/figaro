@props(['key' => 'showCreateBarber'])

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Se encontraron errores',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            background: '#2A2A2A',
            color: 'white',
            iconColor: '#EF4444',
            confirmButtonColor: '#EF4444',
            confirmButtonText: 'Entendido',
            customClass: {
                popup: 'rounded-xl border border-white/10 shadow-lg',
                confirmButton: 'text-white font-semibold px-4 py-2'
            }
        }).then(() => {
            // Esperamos a que se cierre SweetAlert, y luego forzamos el modal abierto
            const el = document.querySelector('[x-data]');
if (el && el.__x) {
    el.__x.$data.showCreateBarber = true;
}

        });
    });
</script>
@endif
