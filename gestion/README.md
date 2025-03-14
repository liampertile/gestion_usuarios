# Sistema de Gestión Académica

Sistema web para la gestión de cursos, docentes y estudiantes desarrollado con Laravel.

## Requisitos Previos

- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js y NPM

## Instalación

1. Clonar el repositorio:
```bash
git clone [URL_DEL_REPOSITORIO]
cd gestion
```

2. Instalar dependencias de PHP:
```bash
composer install
```

3. Instalar dependencias de Node.js:
```bash
npm install
```

4. Copiar el archivo de configuración:
```bash
cp .env.example .env
```

5. Generar la clave de la aplicación:
```bash
php artisan key:generate
```

6. Configurar la base de datos en el archivo `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_usuarios
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

7. Ejecutar las migraciones:
```bash
php artisan migrate
```

8. Compilar los assets:
```bash
npm run dev
```

## Ejecutar el Proyecto

1. Iniciar el servidor de desarrollo:
```bash
php artisan serve
```

2. En otra terminal, ejecutar el compilador de assets (opcional, solo si se van a hacer cambios en el frontend):
```bash
npm run dev
```

3. Acceder al proyecto en el navegador:
```
http://localhost:8000
```

## Estructura del Proyecto

El sistema incluye las siguientes funcionalidades:

- Gestión de Cursos
  - Crear, editar, eliminar y listar cursos
  - Asignar docentes y estudiantes a los cursos
  - Filtrar cursos por estado (activos/inactivos)
  - Filtrar estudiantes por docente

- Gestión de Docentes
  - CRUD completo de docentes

- Gestión de Estudiantes
  - CRUD completo de estudiantes
  - Asignación a cursos

## Base de Datos

El sistema utiliza las siguientes tablas principales:
- courses (cursos)
- teachers (docentes)
- students (estudiantes)
- subjects (asignaturas)
- course_students (relación entre cursos y estudiantes)
