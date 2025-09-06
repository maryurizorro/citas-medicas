# Sistema de Citas Médicas - API Laravel

Este es un sistema de gestión de citas médicas desarrollado con Laravel que proporciona una API REST completa para manejar médicos, pacientes y citas.

## 🚀 Características

- *Gestión de Médicos*: CRUD completo para médicos con especialidades
- *Gestión de Pacientes*: CRUD completo para pacientes
- *Gestión de Citas*: CRUD completo para citas con estados (pendiente, confirmada, cancelada)
- *Validaciones*: Validaciones robustas para evitar conflictos de horarios
- *Relaciones*: Relaciones Eloquent entre entidades
- *API REST*: Endpoints RESTful bien documentados

## 📋 Requisitos

- PHP 8.1 o superior
- Composer
- MySQL 5.7 o superior
- Laravel 10.x

## 🛠 Instalación

1.  *Clonar el repositorio*
    bash
    git clone <url-del-repositorio>
    cd citas
    

2.  *Instalar dependencias*
    bash
    composer install
    

3.  *Configurar la base de datos*
    
    Copia el archivo .env.example a .env:
    bash
    cp .env.example .env
    
    
    Edita el archivo .env con tu configuración de base de datos:
    env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=citas_medicas
    DB_USERNAME=root
    DB_PASSWORD=tu_password
    

4.  *Generar clave de aplicación*
    bash
    php artisan key:generate
    

5.  *Ejecutar migraciones*
    bash
    php artisan migrate
    

6.  *Poblar la base de datos con datos de prueba*
    bash
    php artisan db:seed
    

7.  *Iniciar el servidor*
    bash
    php artisan serve
    

## 🗄 Estructura de la Base de Datos

### Tabla: medicos
- id - Clave primaria
- nombre - Nombre del médico
- apellido - Apellido del médico
- especialidad - Especialidad médica
- email - Email único del médico
- created_at, updated_at - Timestamps

### Tabla: pacientes
- id - Clave primaria
- nombre - Nombre del paciente
- apellido - Apellido del paciente
- email - Email único del paciente
- telefono - Teléfono del paciente (opcional)
- created_at, updated_at - Timestamps

### Tabla: citas
- id - Clave primaria
- paciente_id - Clave foránea a pacientes
- medico_id - Clave foránea a médicos
- fecha - Fecha y hora de la cita
- estado - Estado de la cita (pendiente, confirmada, cancelada)
- observaciones - Observaciones adicionales (opcional)
- created_at, updated_at - Timestamps

## 📡 Endpoints de la API

### Médicos
- GET /api/listarMedicos - Obtener todos los médicos
- POST /api/crearMedico - Crear nuevo médico
- GET /api/medico/{id} - Obtener médico específico
- PUT /api/actualizarMedico/{id} - Actualizar médico
- DELETE /api/eliminarMedico/{id} - Eliminar médico
- GET /api/medicosPorEspecialidad/{especialidad} - Obtener médicos por especialidad

### Pacientes
- GET /api/listarPacientes - Obtener todos los pacientes
- POST /api/crearPaciente - Crear nuevo paciente
- GET /api/paciente/{id} - Obtener paciente específico
- PUT /api/actualizarPaciente/{id} - Actualizar paciente
- DELETE /api/eliminarPaciente/{id} - Eliminar paciente

### Citas
- GET /api/listarCitas - Obtener todas las citas
- POST /api/crearCita - Crear nueva cita
- GET /api/cita/{id} - Obtener cita específica
- PUT /api/actualizarCita/{id} - Actualizar cita
- DELETE /api/eliminarCita/{id} - Eliminar cita
- GET /api/citasPendientes - Obtener citas pendientes
- GET /api/citasConfirmadas - Obtener citas confirmadas
- GET /api/citasCanceladas - Obtener citas canceladas
- GET /api/citasPorMedico/{medico_id} - Obtener citas por médico
- GET /api/citasPorPaciente/{paciente_id} - Obtener citas por paciente

## Códigos de Respuesta

- **200**: OK - Operación exitosa
- **201**: Created - Recurso creado exitosamente
- **400**: Bad Request - Datos inválidos
- **404**: Not Found - Recurso no encontrado
- **422**: Unprocessable Entity - Error de validación
- **500**: Internal Server Error - Error del servidor
