# Documentación de la API - Sistema de Citas Médicas

## Base URL
```
http://localhost:8000/api
```

## Autenticación
La API utiliza Laravel Sanctum para autenticación. Para rutas protegidas, incluye el token Bearer en el header:
```
Authorization: Bearer {token}
```

## Endpoints

### Citas

#### Listar todas las citas
- **GET** `/listarCitas`
- **Descripción**: Obtiene todas las citas con información de paciente y médico
- **Respuesta**: Array de citas

#### Crear cita
- **POST** `/crearCita`
- **Body**:
```json
{
    "paciente_id": 1,
    "medico_id": 1,
    "fecha": "2024-01-15 10:00:00",
    "observaciones": "Consulta de rutina"
}
```

#### Obtener cita específica
- **GET** `/cita/{id}`
- **Descripción**: Obtiene una cita específica con información de paciente y médico

#### Actualizar cita
- **PUT** `/actualizarCita/{id}`
- **Body**:
```json
{
    "fecha": "2024-01-15 11:00:00",
    "estado": "confirmada",
    "observaciones": "Consulta reprogramada"
}
```

#### Eliminar cita
- **DELETE** `/eliminarCita/{id}`

#### Citas por estado
- **GET** `/citasPendientes` - Citas con estado "pendiente"
- **GET** `/citasConfirmadas` - Citas con estado "confirmada"
- **GET** `/citasCanceladas` - Citas con estado "cancelada"

#### Citas por filtros
- **GET** `/citasPorMedico/{medico_id}` - Citas de un médico específico
- **GET** `/citasPorPaciente/{paciente_id}` - Citas de un paciente específico
- **GET** `/citasPorFecha/{fecha}` - Citas en una fecha específica (formato: YYYY-MM-DD)
- **GET** `/citasEntreFechas/{fecha_inicio}/{fecha_fin}` - Citas entre dos fechas

#### Acciones de cita
- **PUT** `/confirmarCita/{id}` - Confirma una cita
- **PUT** `/cancelarCita/{id}` - Cancela una cita

### Médicos

#### Listar todos los médicos
- **GET** `/listarMedicos`

#### Crear médico
- **POST** `/crearMedico`
- **Body**:
```json
{
    "nombre": "Dr. Juan",
    "apellido": "Pérez",
    "especialidad": "Cardiología",
    "email": "juan.perez@hospital.com"
}
```

#### Obtener médico específico
- **GET** `/medico/{id}`

#### Actualizar médico
- **PUT** `/actualizarMedico/{id}`

#### Eliminar médico
- **DELETE** `/eliminarMedico/{id}`

#### Médicos por especialidad
- **GET** `/medicosPorEspecialidad/{especialidad}`

#### Médicos disponibles
- **GET** `/medicosDisponibles/{fecha}` - Médicos disponibles en una fecha específica

### Pacientes

#### Listar todos los pacientes
- **GET** `/listarPacientes`

#### Crear paciente
- **POST** `/crearPaciente`
- **Body**:
```json
{
    "nombre": "María",
    "apellido": "García",
    "email": "maria.garcia@email.com",
    "telefono": "123456789"
}
```

#### Obtener paciente específico
- **GET** `/paciente/{id}`

#### Actualizar paciente
- **PUT** `/actualizarPaciente/{id}`

#### Eliminar paciente
- **DELETE** `/eliminarPaciente/{id}`

#### Pacientes por médico
- **GET** `/pacientesPorMedico/{medico_id}` - Pacientes que han tenido citas con un médico específico

### Especialidades

#### Listar todas las especialidades
- **GET** `/listarEspecialidades`

#### Crear especialidad
- **POST** `/crearEspecialidad`
- **Body**:
```json
{
    "nombre": "Cardiología",
    "descripcion": "Especialidad médica que se encarga del corazón y sistema cardiovascular"
}
```

#### Obtener especialidad específica
- **GET** `/especialidad/{id}`

#### Actualizar especialidad
- **PUT** `/actualizarEspecialidad/{id}`

#### Eliminar especialidad
- **DELETE** `/eliminarEspecialidad/{id}`

### Usuarios

#### Listar todos los usuarios
- **GET** `/listarUsuarios`

#### Crear usuario
- **POST** `/crearUsuario`
- **Body**:
```json
{
    "nombre": "Admin",
    "email": "admin@hospital.com",
    "password": "password123",
    "rol": "admin"
}
```

#### Obtener usuario específico
- **GET** `/usuario/{id}`

#### Actualizar usuario
- **PUT** `/actualizarUsuario/{id}`

#### Eliminar usuario
- **DELETE** `/eliminarUsuario/{id}`

## Códigos de Respuesta

- **200**: OK - Operación exitosa
- **201**: Created - Recurso creado exitosamente
- **400**: Bad Request - Datos inválidos
- **404**: Not Found - Recurso no encontrado
- **422**: Unprocessable Entity - Error de validación
- **500**: Internal Server Error - Error del servidor

## Ejemplos de Uso

### Crear una cita
```bash
curl -X POST http://localhost:8000/api/crearCita \
  -H "Content-Type: application/json" \
  -d '{
    "paciente_id": 1,
    "medico_id": 1,
    "fecha": "2024-01-15 10:00:00",
    "observaciones": "Consulta de rutina"
  }'
```

### Obtener citas pendientes
```bash
curl -X GET http://localhost:8000/api/citasPendientes
```

### Confirmar una cita
```bash
curl -X PUT http://localhost:8000/api/confirmarCita/1
```

### Obtener médicos disponibles
```bash
curl -X GET http://localhost:8000/api/medicosDisponibles/2024-01-15
```
