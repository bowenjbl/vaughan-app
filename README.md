## Prueba Técnica Backend Vaughan

Creación de una API para acortar URL usando TinyURL y BitLy. Se puede cambiar de servicio seteando la variable env `URL_SHORTENER_DRIVER` con bitly o tiny_url, por defecto tiny_url.

## Instalación:

1. Clonar el repositorio: `git clone https://github.com/bowenjbl/vaughan-app.git`.
2. Mover al directorio: `cd vaughan-app`.
3. Duplicar el fichero `cp .env.example .env`
4. Instalar las dependencias: `composer install`.
5. Generar una llave: `php artisan key:generate`.
6. Iniciar servidor: `php artisan serve`.

## Tests:
Ejecutar: `php artisan test`.

## API endpoints:

```
Generar una nueva URL acortada
POST - http://127.0.0.1:8000/api/v1/short-urls
Body object:
{
  "url": "https://www.google.es/",
}

