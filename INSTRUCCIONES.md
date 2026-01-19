# Fitxategi - Sistema de Control de Asistencia para Coworking

## 📋 Descripción del Proyecto

Aplicación web de control de asistencia diseñada para espacios de coworking, con interfaz mobile-first pero accesible desde escritorio. Permite a los estudiantes registrar su entrada y salida, y a profesores y administradores gestionar y visualizar reportes de asistencia.

## ✨ Características Implementadas

### Sistema de Roles
- **Estudiante**: Registrar entrada/salida y consultar historial propio
- **Profesor**: Acceso a todas las asistencias, reportes y validación
- **Administrador**: Acceso completo al sistema

### Funcionalidades Principales

1. **Dashboard con Cronómetro**
   - Diseño mobile-first similar a la imagen de referencia
   - Cronómetro en tiempo real cuando hay asistencia activa
   - Botón de Iniciar/Finalizar asistencia
   - Calendario mensual con visualización de días con asistencia

2. **Gestión de Asistencias**
   - Registro de entrada (check-in)
   - Registro de salida (check-out)
   - Cálculo automático de duración
   - Historial personal de asistencias
   - Estados: activo, completado, incompleto

3. **Reportes y Estadísticas** (Profesor/Administrador)
   - Vista de todas las asistencias
   - Filtros por usuario, fecha
   - Estadísticas: total de asistencias, horas totales, usuarios activos
   - Exportación a CSV
   - Promedio diario de horas

4. **Interfaz de Usuario**
   - Diseño responsive mobile-first
   - Tema oscuro/claro
   - Navegación intuitiva
   - Animaciones y transiciones suaves

## 🚀 Tecnologías Utilizadas

- **Backend**: Laravel 11.47.0
- **Frontend**: Blade Templates + Tailwind CSS + Alpine.js
- **Base de Datos**: SQLite
- **Autenticación**: Laravel Breeze
- **PHP**: 8.3.30

## 📦 Instalación

### Requisitos Previos
- PHP >= 8.3
- Composer
- Node.js y NPM

### Pasos de Instalación

```bash
# 1. Clonar el repositorio (si aplica)
cd /Applications/fitxategi

# 2. Instalar dependencias de PHP
composer install

# 3. Instalar dependencias de Node
npm install

# 4. Copiar archivo de entorno (si no existe)
cp .env.example .env

# 5. Generar clave de aplicación
php artisan key:generate

# 6. Ejecutar migraciones y seeders
php artisan migrate:fresh --seed

# 7. Compilar assets
npm run build

# 8. Iniciar servidor de desarrollo
php artisan serve
```

## 👥 Usuarios de Prueba

El sistema viene con 3 usuarios precargados para pruebas:

### Administrador
- **Email**: admin@fitxategi.com
- **Password**: password
- **Acceso**: Completo al sistema

### Profesor
- **Email**: profesor@fitxategi.com
- **Password**: password
- **Acceso**: Todas las asistencias y reportes

### Estudiante
- **Email**: estudiante@fitxategi.com
- **Password**: password
- **Acceso**: Registro propio y historial personal

## 🎯 Uso de la Aplicación

### Para Estudiantes

1. **Iniciar sesión** con las credenciales de estudiante
2. En el **Dashboard**, presionar el botón "Iniciar" para registrar entrada
3. El cronómetro comenzará a contar en tiempo real
4. Presionar "Finalizar" para registrar la salida
5. Ver el calendario con los días trabajados marcados
6. Acceder a "Mi Historial" para ver todas las asistencias

### Para Profesores/Administradores

1. **Iniciar sesión** con credenciales de profesor o administrador
2. Acceder a **"Todas las Asistencias"** para ver registros de todos los usuarios
3. Usar **filtros** para buscar por usuario o rango de fechas
4. Ir a **"Reportes"** para ver estadísticas generales:
   - Total de asistencias
   - Horas totales
   - Usuarios activos
   - Promedio diario
5. **Exportar** datos a CSV para análisis externo

## 📊 Estructura de la Base de Datos

### Tablas Principales

**roles**
- id, name, description

**users**
- id, name, email, password, role_id, phone, identification, is_active

**attendances**
- id, user_id, check_in, check_out, total_minutes, date, status, notes, location

## 🎨 Diseño de la Interfaz

La aplicación sigue un diseño mobile-first con:
- Cards redondeadas con sombras suaves
- Paleta de colores neutros con acentos
- Tipografía clara y legible
- Iconos SVG para mejor rendimiento
- Calendario visual mensual
- Cronómetro prominente y fácil de leer
- Botones grandes y accesibles

## 📱 Responsive Design

La aplicación está optimizada para:
- **Móviles** (< 640px): Diseño principal
- **Tablets** (640px - 1024px): Adaptación a pantalla mediana
- **Desktop** (> 1024px): Aprovechamiento de espacio adicional

## 🔒 Seguridad

- Autenticación mediante Laravel Breeze
- Middleware de roles para control de acceso
- Validación de permisos en cada ruta
- Protección CSRF en formularios
- Passwords hasheados con bcrypt

## 📈 Funcionalidades Futuras

- Exportación a PDF con gráficos
- Exportación a Excel con formato
- Notificaciones por email
- Gestión de usuarios desde admin
- Registro de ubicación con GPS
- API REST para integraciones
- Estadísticas avanzadas con gráficos
- Sistema de incidencias y justificaciones

## 🛠️ Comandos Útiles

```bash
# Iniciar servidor de desarrollo
php artisan serve

# Compilar assets en desarrollo
npm run dev

# Compilar assets para producción
npm run build

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Crear nuevo usuario manualmente
php artisan tinker
> User::create([...])

# Ver logs en tiempo real
php artisan pail
```

## 📝 Notas de Desarrollo

- El sistema usa SQLite por defecto para facilitar el desarrollo
- Los timestamps están en UTC, se recomienda configurar timezone en .env
- El cronómetro funciona con JavaScript y se actualiza cada segundo
- Las exportaciones CSV incluyen BOM para compatibilidad con Excel

## 🤝 Contribución

Este proyecto fue desarrollado como parte de un sistema de gestión de coworking. 

## 📄 Licencia

MIT License - Ver archivo LICENSE para más detalles.

## 📧 Soporte

Para soporte o preguntas sobre el sistema, contactar al administrador del proyecto.

---

**Desarrollado con Laravel 11 y ❤️**

