# Beneficios Anuales API

Servicio para consultar los benefecios por año que ha recibido un usuario, indicando número de beneficios y el monto total obtenido por cada año.

## Documentación

La url base de la API es: `/api/v1`

### Endpoints

#### ```GET``` /beneficios/anuales

Obtener todos los beneficios del usuario agrupados por año

#### Parámetros

El endpoint no require parámetros de entrada. El `contentype` aceptadado es `aplication\josn`

#### Respuesta

Al consultar el endpoint se debe esperar una respuesta de este tipo

```
{
    "code': "200",
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

## Instalación y configuración

1. En la raiz del proyecto se debe crear el archivo `.env` y pegarle el contenido disponible en el archivo `.env.example`

2. Una vez configurado el archivo `.env`, se debe agregar la siguiente variable de entorno para consumir datos de la API externa de beneficios

```
BENEFICIOS_API_BASE_URL="https://run.mocky.io/v3"
```

3. Por último antes de levantar los servicios se debe generar la `app_key` del proyecto, para ello se ejecuta el comando

```
php artisan key:generate
```

## Levantar Servicios




## Postman

Se puede importar la colección de `Postman` disponible en el proyecto para probar los endpoints disponibles.

```
📁 Archivo: /postman/beneficios_anuales_postman.json
```
