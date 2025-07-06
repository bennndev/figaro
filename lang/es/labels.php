<?php

return [
    'fields' => [
        // Barberos
        'barber' => [
            'name' => 'Nombre',
            'last_name' => 'Apellido',
            'full_name' => 'Nombre Completo',
            'email' => 'Correo Electrónico',
            'phone_number' => 'Número de Teléfono',
            'password' => 'Contraseña',
            'password_confirmation' => 'Confirmar Contraseña',
            'profile_photo' => 'Foto de Perfil',
            'description' => 'Descripción',
            'specialties' => 'Especialidades',
            'status' => 'Estado',
            'is_active' => 'Activo',
            'created_at' => 'Fecha de Creación',
            'updated_at' => 'Fecha de Actualización',
        ],
        
        // Especialidades
        'specialty' => [
            'name' => 'Nombre',
            'description' => 'Descripción',
            'is_active' => 'Activo',
            'created_at' => 'Fecha de Creación',
            'updated_at' => 'Fecha de Actualización',
        ],

        // Servicios
        'service' => [
            'name' => 'Nombre',
            'description' => 'Descripción',
            'price' => 'Precio',
            'duration' => 'Duración (minutos)',
            'is_active' => 'Activo',
            'specialty_id' => 'Especialidad',
            'created_at' => 'Fecha de Creación',
            'updated_at' => 'Fecha de Actualización',
        ],

        // Reservas
        'reservation' => [
            'date' => 'Fecha',
            'start_time' => 'Hora de Inicio',
            'end_time' => 'Hora de Fin',
            'notes' => 'Notas',
            'status' => 'Estado',
            'total_price' => 'Precio Total',
            'barber_id' => 'Barbero',
            'user_id' => 'Cliente',
            'service_id' => 'Servicio',
            'created_at' => 'Fecha de Reserva',
            'updated_at' => 'Fecha de Actualización',
        ],

        // Usuarios/Clientes
        'user' => [
            'name' => 'Nombre',
            'last_name' => 'Apellido',
            'full_name' => 'Nombre Completo',
            'email' => 'Correo Electrónico',
            'phone_number' => 'Número de Teléfono',
            'password' => 'Contraseña',
            'password_confirmation' => 'Confirmar Contraseña',
            'birth_date' => 'Fecha de Nacimiento',
            'created_at' => 'Fecha de Registro',
            'updated_at' => 'Fecha de Actualización',
        ],

        // Horarios
        'schedule' => [
            'day_of_week' => 'Día de la Semana',
            'start_time' => 'Hora de Inicio',
            'end_time' => 'Hora de Fin',
            'is_active' => 'Activo',
            'barber_id' => 'Barbero',
            'created_at' => 'Fecha de Creación',
            'updated_at' => 'Fecha de Actualización',
        ],

        // Administradores
        'admin' => [
            'name' => 'Nombre',
            'email' => 'Correo Electrónico',
            'password' => 'Contraseña',
            'password_confirmation' => 'Confirmar Contraseña',
            'role' => 'Rol',
            'is_active' => 'Activo',
            'last_login' => 'Último Acceso',
            'created_at' => 'Fecha de Creación',
            'updated_at' => 'Fecha de Actualización',
        ],

        // Pagos
        'payment' => [
            'amount' => 'Monto',
            'method' => 'Método de Pago',
            'status' => 'Estado',
            'transaction_id' => 'ID de Transacción',
            'reservation_id' => 'Reserva',
            'processed_at' => 'Fecha de Procesamiento',
            'created_at' => 'Fecha de Creación',
            'updated_at' => 'Fecha de Actualización',
        ],
    ],

    'entities' => [
        'barber' => [
            'singular' => 'Barbero',
            'plural' => 'Barberos',
        ],
        'specialty' => [
            'singular' => 'Especialidad',
            'plural' => 'Especialidades',
        ],
        'service' => [
            'singular' => 'Servicio',
            'plural' => 'Servicios',
        ],
        'reservation' => [
            'singular' => 'Reserva',
            'plural' => 'Reservas',
        ],
        'user' => [
            'singular' => 'Cliente',
            'plural' => 'Clientes',
        ],
        'schedule' => [
            'singular' => 'Horario',
            'plural' => 'Horarios',
        ],
        'admin' => [
            'singular' => 'Administrador',
            'plural' => 'Administradores',
        ],
        'payment' => [
            'singular' => 'Pago',
            'plural' => 'Pagos',
        ],
    ],

    'actions' => [
        'create' => 'Crear',
        'edit' => 'Editar',
        'update' => 'Actualizar',
        'delete' => 'Eliminar',
        'show' => 'Ver',
        'cancel' => 'Cancelar',
        'save' => 'Guardar',
        'back' => 'Volver',
        'search' => 'Buscar',
        'filter' => 'Filtrar',
        'clear' => 'Limpiar',
        'select' => 'Seleccionar',
        'confirm' => 'Confirmar',
        'add' => 'Agregar',
        'remove' => 'Quitar',
        'submit' => 'Enviar',
        'reset' => 'Restablecer',
        'export' => 'Exportar',
        'import' => 'Importar',
        'download' => 'Descargar',
        'upload' => 'Subir',
        'activate' => 'Activar',
        'deactivate' => 'Desactivar',
    ],

    'status' => [
        'active' => 'Activo',
        'inactive' => 'Inactivo',
        'pending' => 'Pendiente',
        'confirmed' => 'Confirmado',
        'cancelled' => 'Cancelado',
        'completed' => 'Completado',
        'rejected' => 'Rechazado',
        'processing' => 'Procesando',
        'failed' => 'Fallido',
        'success' => 'Exitoso',
    ],

    'days' => [
        'monday' => 'Lunes',
        'tuesday' => 'Martes', 
        'wednesday' => 'Miércoles',
        'thursday' => 'Jueves',
        'friday' => 'Viernes',
        'saturday' => 'Sábado',
        'sunday' => 'Domingo',
    ],

    'messages' => [
        'success' => [
            'created' => ':entity creado exitosamente.',
            'updated' => ':entity actualizado exitosamente.',
            'deleted' => ':entity eliminado exitosamente.',
            'activated' => ':entity activado exitosamente.',
            'deactivated' => ':entity desactivado exitosamente.',
        ],
        'error' => [
            'not_found' => ':entity no encontrado.',
            'delete_failed' => 'Error al eliminar :entity.',
            'update_failed' => 'Error al actualizar :entity.',
            'create_failed' => 'Error al crear :entity.',
            'general' => 'Ha ocurrido un error inesperado.',
        ],
        'confirm' => [
            'delete' => '¿Estás seguro de que deseas eliminar este :entity?',
            'activate' => '¿Estás seguro de que deseas activar este :entity?',
            'deactivate' => '¿Estás seguro de que deseas desactivar este :entity?',
        ],
        'validation' => [
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'El campo :attribute debe ser un correo electrónico válido.',
            'unique' => 'El :attribute ya está en uso.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'confirmed' => 'La confirmación de :attribute no coincide.',
            'numeric' => 'El campo :attribute debe ser un número.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'image' => 'El campo :attribute debe ser una imagen.',
            'mimes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
            'exists' => 'El :attribute seleccionado no es válido.',
            'in' => 'El :attribute seleccionado no es válido.',
        ],
    ],

    'navigation' => [
        'dashboard' => 'Panel de Control',
        'barbers' => 'Barberos',
        'specialties' => 'Especialidades',
        'services' => 'Servicios',
        'reservations' => 'Reservas',
        'clients' => 'Clientes',
        'schedules' => 'Horarios',
        'payments' => 'Pagos',
        'reports' => 'Reportes',
        'settings' => 'Configuración',
        'profile' => 'Perfil',
        'logout' => 'Cerrar Sesión',
    ],

    'general' => [
        'yes' => 'Sí',
        'no' => 'No',
        'none' => 'Ninguno',
        'all' => 'Todos',
        'loading' => 'Cargando...',
        'no_data' => 'No hay datos disponibles.',
        'total' => 'Total',
        'subtotal' => 'Subtotal',
        'from' => 'Desde',
        'to' => 'Hasta',
        'date' => 'Fecha',
        'time' => 'Hora',
        'duration' => 'Duración',
        'price' => 'Precio',
        'description' => 'Descripción',
        'notes' => 'Notas',
        'optional' => 'Opcional',
        'required' => 'Obligatorio',
        'select_option' => 'Seleccione una opción',
        'no_options' => 'No hay opciones disponibles',
    ],
];
