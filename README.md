<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Task Management System Deployment Guide

Este documento describe los pasos necesarios para desplegar localmente una aplicación Laravel desde GitHub, configurando una base de datos MySQL y asegurando que todo funcione correctamente.

## Requisitos Previos

Antes de comenzar, asegúrate de tener los siguientes requisitos instalados en tu sistema:

- [Composer](https://getcomposer.org/download/)
- [PHP 8.0+](https://www.php.net/downloads.php)
- [MySQL](https://dev.mysql.com/downloads/mysql/)
- [Node](https://nodejs.org/en/download/package-manager/current)
- [Git](https://git-scm.com/downloads)

## Pasos de Despliegue

### 1. Clonar el Repositorio

Clona el repositorio de GitHub en tu máquina local utilizando Git.

```bash
git clone https://github.com/cristhianmoreno06/task_management_system.git
cd task_management_system
composer instal
````
### 2. Instalar Dependencias
   
Usa Composer para instalar todas las dependencias de PHP necesarias.

```bash
composer install
````
### 3. Configurar el Archivo .env

Copia el archivo .env.example a .env y edítalo con tus configuraciones locales.

```bash
cp .env.example .env
````
Abre el archivo .env en un editor de texto y configura los siguientes parámetros:
~~~ 
    APP_NAME="Nombre de tu Aplicación"
    APP_ENV=local
    APP_KEY=base64:jfalksjflasjflkajfklajflasjflasjfl==
    APP_DEBUG=true
    APP_URL=http://localhost
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_de_tu_base_de_datos
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    
    API_ENDPOINT=https://api.example.com
    API_KEY=tu_api_key
~~~

### 4. Generar la Clave de la Aplicación

Genera una nueva clave de aplicación.

```bash
php artisan key:generate
````

### 5. Configurar la Base de Datos

Crea una nueva base de datos MySQL para tu aplicación.

~~~
CREATE DATABASE nombre_de_tu_base_de_datos;
~~~

### 6. Migrar las Tablas de la Base de Datos

Ejecuta las migraciones para crear las tablas necesarias en tu base de datos.

```bash
php artisan migrate
````
### 7. Compilar Archivos de Frontend:

Si estás utilizando Laravel Mix para compilar tus archivos de frontend (CSS/JS), asegúrate de tener Node.js y npm instalados. Luego, puedes ejecutar:

```bash
npm install
npm run dev
````

### 8. Ejecutar el Servidor de Desarrollo

Inicia el servidor de desarrollo de Laravel.

```bash
php artisan serve
````
* Tu aplicación debería estar corriendo ahora en http://localhost:8000.

## Consumo de la API
Para consumir la API se ha incluido un archivo de configuración JSON que puedes descargar o ver en el siguiente enlace:

- [Descargar archivo de configuración JSON](Task-management.postman_collection.json)
