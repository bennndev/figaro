@props(['barberId'])

{{-- Componente para mostrar errores específicos del modal de editar barbero --}}
@if ($errors->any() && (session('modal_context') === 'edit_barber' || request()->routeIs('admin.barbers.update')))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mostrar cada error como un toast individual
        @foreach($errors->all() as $error)
            if (typeof showErrorToast === 'function') {
                showErrorToast('{{ $error }}');
            } else {
                // Fallback si showErrorToast no está disponible
                console.error('showErrorToast no está disponible:', '{{ $error }}');
            }
        @endforeach
        
        // Mantener el modal abierto después de mostrar los errores
        setTimeout(() => {
            // Buscar el modal específico del barbero
            const editModal = document.querySelector('[x-on\\:open-modal-edit-barber-{{ $barberId }}\\.window]');
            if (editModal && editModal.__x && editModal.__x.$data.hasOwnProperty('showEditModal')) {
                console.log('Reabriendo modal de editar barbero {{ $barberId }}');
                editModal.__x.$data.showEditModal = true;
            } else {
                console.log('No se encontró el modal de editar barbero {{ $barberId }}');
                // Fallback: disparar el evento personalizado
                window.dispatchEvent(new CustomEvent('open-modal-edit-barber-{{ $barberId }}'));
            }
        }, 100);
    });
</script>
@endif