# Beneficios Anuales API

Servicio para consultar los beneficios por año que ha recibido un usuario, indicando el número de beneficios y el monto total obtenido por cada año.

## Instalación y configuración

1. Una vez clonado el proyecto, en la raíz, se debe crear el archivo `.env` y copiar el contenido disponible en el archivo `.env.example`

2. Una vez configurado el archivo `.env`, se debe agregar la siguiente variable de entorno para consumir datos de la API externa de beneficios:

    ```php
    BENEFICIOS_API_BASE_URL="https://run.mocky.io/v3"
    ```

## Levantar Servicios

### Docker

Esta sección describe cómo iniciar los servicios con `docker-compose`.

### Requisitos previos

Tener instalado `docker` y `docker-compose` en tu máquina.

## Comandos básicos

1. Ejecutar el siguiente comando para iniciar todos los servicios en segundo plano:
    ```
    docker-compose up -d
    ```

2. Para verificar que los servicios están corriendo, utiliza:
    ```
    docker-compose ps
    ```

3. Para detener los servicios:
    ```
    docker-compose down
    ```

### Local

En esta sección se describe como levantar los servicios en local

#### Requisitos

- PHP >=8.1 y <=8.2
- Composer

#### Pasos para ejecutar en local

1. Instala las dependencias con `composer`:
    ```sh
    composer install
    ```
2. Genera la APP_KEY:
    ```sh
    php artisan key:generate
    ```
4. Levanta el servidor local en el puerto `:8000`
    ```php
    php artisan serve --port=8000
    ```

## Documentación API

La URL base de la API es: `/api/v1`

### Endpoints

#### ```GET``` /beneficios/anuales

Obtener todos los beneficios del usuario agrupados por año

#### Parámetros

El endpoint no requiere parámetros de entrada.

#### Respuesta

Al consultar el endpoint, se debe esperar una respuesta de este tipo:

```json
{
    "code": "200",
    "success": true,
    "data": [
        {
            "year": 2024,
            "monto_total": 50000,
            "numero_beneficios": 1,
            "beneficios": [
                {
                    "id_programa": 1,
                    "monto": 50000,
                    "fecha_recepcion": "09/11/2024",
                    "fecha": "2024-11-09",
                    "ano": "2024",
                    "view": true,
                    "ficha": {
                        "id": 922,
                        "nombre": "Emprende",
                        "id_programa": 1,
                        "url": "emprende",
                        "categoria": "trabajo",
                        "descripcion": "Fondos concursables para nuevos negocios"
                    }
                }
            ]
        }
    ]
}
```

## Testing

### Pruebas disponibles

Este proyecto cuenta pruebas automatizadas para asegurar la correcta funcionalidad del código. Actualmente, se incluyen los siguientes tipos de tests:

- Feature Tests
- Unit Tests

### Ejecutar pruebas

- Docker
    ```sh
    docker-compose exec app php artisan test
    ```
- Local
    ```sh
    php artisan test
    ```

## Postman

Se puede importar la colección de `Postman` disponible en el proyecto para probar los endpoints disponibles.

```
📁 Archivo: /postman/beneficios_anuales_postman.json
```
