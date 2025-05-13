# Beneficios Anuales API

Servicio para consultar los beneficios por año que ha recibido un usuario, indicando el número de beneficios y el monto total obtenido por cada año.

## Instalación y configuración

1. En la raíz del proyecto, se debe crear el archivo `.env` y copiar el contenido disponible en el archivo `.env.example`

2. Una vez configurado el archivo `.env`, se debe agregar la siguiente variable de entorno para consumir datos de la API externa de beneficios:

    ```php
    BENEFICIOS_API_BASE_URL="https://run.mocky.io/v3"
    ```

3. Por último, antes de levantar los servicios, se debe generar la `app_key` del proyecto. Para ello, se ejecuta el siguiente comando:

    ```sh
    php artisan key:generate
    ```

## Levantar Servicios

Esta sección describe cómo iniciar los servicios con `docker-compose`.

### Requisitos previos

Tener instalado `docker` y `docker-compose` en tu máquina.

## Comandos

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

## Documentación

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

## Postman

Se puede importar la colección de `Postman` disponible en el proyecto para probar los endpoints disponibles.

```
📁 Archivo: /postman/beneficios_anuales_postman.json
```
