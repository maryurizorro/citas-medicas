# Sistema de Citas Médicas - API Laravel

Este es un sistema de gestión de citas médicas desarrollado con Laravel que proporciona una API REST completa para manejar médicos, pacientes y citas.

## 🚀 Características

- **Gestión de Médicos**: CRUD completo para médicos con especialidades
- **Gestión de Pacientes**: CRUD completo para pacientes
- **Gestión de Citas**: CRUD completo para citas con estados (pendiente, confirmada, cancelada)
- **Validaciones**: Validaciones robustas para evitar conflictos de horarios
- **Relaciones**: Relaciones Eloquent entre entidades
- **API REST**: Endpoints RESTful bien documentados

## 📋 Requisitos

- PHP 8.1 o superior
- Composer
- MySQL 5.7 o superior
- Laravel 10.x

## 🛠️ Instalación

1. **Clonar el repositorio**
   ```bash
   git clone <url-del-repositorio>
   cd citas
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   ```

3. **Configurar la base de datos**
   
   Copia el archivo `.env.example` a `.env`:
   ```bash
   cp .env.example .env
   ```
   
   Edita el archivo `.env` con tu configuración de base de datos:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=citas_medicas
   DB_USERNAME=root
   DB_PASSWORD=tu_password
   ```

4. **Generar clave de aplicación**
   ```bash
   php artisan key:generate
   ```

5. **Ejecutar migraciones**
   ```bash
   php artisan migrate
   ```

6. **Poblar la base de datos con datos de prueba**
   ```bash
   php artisan db:seed
   ```

7. **Iniciar el servidor**
   ```bash
   php artisan serve
   ```

## 🗄️ Estructura de la Base de Datos

### Tabla: `medicos`
- `id` - Clave primaria
- `nombre` - Nombre del médico
- `apellido` - Apellido del médico
- `especialidad` - Especialidad médica
- `email` - Email único del médico
- `created_at`, `updated_at` - Timestamps

### Tabla: `pacientes`
- `id` - Clave primaria
- `nombre` - Nombre del paciente
- `apellido` - Apellido del paciente
- `email` - Email único del paciente
- `telefono` - Teléfono del paciente (opcional)
- `created_at`, `updated_at` - Timestamps

### Tabla: `citas`
- `id` - Clave primaria
- `paciente_id` - Clave foránea a pacientes
- `medico_id` - Clave foránea a médicos
- `fecha` - Fecha y hora de la cita
- `estado` - Estado de la cita (pendiente, confirmada, cancelada)
- `observaciones` - Observaciones adicionales (opcional)
- `created_at`, `updated_at` - Timestamps

## 📡 Endpoints de la API

### Médicos
- `GET /api/listarMedicos` - Obtener todos los médicos
- `POST /api/crearMedico` - Crear nuevo médico
- `GET /api/medico/{id}` - Obtener médico específico
- `PUT /api/actualizarMedico/{id}` - Actualizar médico
- `DELETE /api/eliminarMedico/{id}` - Eliminar médico
- `GET /api/medicosPorEspecialidad/{especialidad}` - Obtener médicos por especialidad

### Pacientes
- `GET /api/listarPacientes` - Obtener todos los pacientes
- `POST /api/crearPaciente` - Crear nuevo paciente
- `GET /api/paciente/{id}` - Obtener paciente específico
- `PUT /api/actualizarPaciente/{id}` - Actualizar paciente
- `DELETE /api/eliminarPaciente/{id}` - Eliminar paciente

### Citas
- `GET /api/listarCitas` - Obtener todas las citas
- `POST /api/crearCita` - Crear nueva cita
- `GET /api/cita/{id}` - Obtener cita específica
- `PUT /api/actualizarCita/{id}` - Actualizar cita
- `DELETE /api/eliminarCita/{id}` - Eliminar cita
- `GET /api/citasPendientes` - Obtener citas pendientes
- `GET /api/citasConfirmadas` - Obtener citas confirmadas
- `GET /api/citasCanceladas` - Obtener citas canceladas
- `GET /api/citasPorMedico/{medico_id}` - Obtener citas por médico
- `GET /api/citasPorPaciente/{paciente_id}` - Obtener citas por paciente

## 📝 Ejemplos de Uso

### Crear un médico
```bash
curl -X POST http://localhost:8000/api/crearMedico \
  -H "Content-Type: application/json" \
  -d '{
    "nombre": "Dr. Juan",
    "apellido": "García",
    "especialidad": "Cardiología",
    "email": "juan.garcia@hospital.com"
  }'
```

### Crear un paciente
```bash
curl -X POST http://localhost:8000/api/crearPaciente \
  -H "Content-Type: application/json" \
  -d '{
    "nombre": "Pedro",
    "apellido": "González",
    "email": "pedro.gonzalez@email.com",
    "telefono": "555-0101"
  }'
```

### Crear una cita
```bash
curl -X POST http://localhost:8000/api/crearCita \
  -H "Content-Type: application/json" \
  -d '{
    "paciente_id": 1,
    "medico_id": 1,
    "fecha": "2024-01-15 10:00:00",
    "observaciones": "Primera consulta cardiológica"
  }'
```

## 🔧 Validaciones

- **Médicos**: Email único, campos requeridos
- **Pacientes**: Email único, campos requeridos
- **Citas**: 
  - Fecha debe ser futura
  - No puede haber conflictos de horarios para el mismo médico
  - Paciente y médico deben existir
  - Estado debe ser uno de: pendiente, confirmada, cancelada

## 🧪 Testing

Para ejecutar las pruebas:
```bash
php artisan test
```

## 📚 Documentación Adicional

La documentación completa de la API está disponible en:
`GET /api/` - Muestra todos los endpoints disponibles

## 🤝 Contribución

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE.md](LICENSE.md) para detalles.
