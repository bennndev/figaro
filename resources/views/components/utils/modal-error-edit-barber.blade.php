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
            const editModal = document.querySelector('[x-data*="showEditModal"]');
            if (editModal && editModal.__x && editModal.__x.$data.hasOwnProperty('showEditModal')) {
                editModal.__x.$data.showEditModal = true;
            }
            
            // También podemos usar el evento personalizado si está disponible
            @if(isset($barberId))
            window.dispatchEvent(new CustomEvent('open-modal-edit-barber-{{ $barberId }}'));
            @endif
        }, 100);
    });
</script>
@endif