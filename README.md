# Laravel + Docker (compose)

## Ambiente local

### Dependencias

Para trabajo en local contamos con un stack virtualizado en Docker. Para que coincida el mismo stack que en QA (apache 2, PHP 7.2, mysql 5.7).

- [Docker](https://www.docker.com)
- [Docker Compose](https://docs.docker.com/compose/install/)




### Antes de empezar

Clonar el repositorio :


```
$ git clone git@github.com:porloscerros/laravel-dockerized.git
$ cd laravel-dockerized/src
```


### Levantar Docker

```
$ docker-compose up
```

Eso queda escuchando en:

```
http://localhost:8088
```


### Configuración

#### Back-end

Abrir otra terminal y seguir los siguientes pasos:

Asignar permisos a directorios y archivos para el usuario de apache :

```
sudo chown $USER:http ./public -R
sudo chown $USER:http ./storage -R
sudo chown $USER:http ./bootstrap/cache -R

find ./public -type d -exec chmod 755 {} \;
find ./public -type f -exec chmod 644 {} \;

find ./storage -type d -exec chmod 775 {} \;
find ./storage -type f -exec chmod 664 {} \;

find ./bootstrap/cache -type d -exec chmod 775 {} \;
```

_Nota_: despues de cambiar permisos en public es probable que haya que restartear el servidor de desarrollo.


Acceder al shell en el contenedor `php-apache`:

```
$ docker-compose exec --user 1000 php-apache /bin/bash
```


Instalar paquetes requeridos por Laravel via composer

```
$ composer install
``` 

Se necesita un archivo que no se versiona para levantar Laravel.

Para generarlo tomar por referencia `.env.example`

```
$ cp .env.example .env
```

Generar hash para la aplicación web `APP_KEY=` con el siguente comando:


```
$ php artisan key:generate
```

Salir del contenedor `php-apache`:
```
$ exit
```


### Acceder

Ahora puede acceder a la aplicación via [http://localhost:8088](http://localhost:8088).

### Útiles

#### PHPmyadmin
Tenemos un contenedor con phpmyadmin corriendo en:

[http://localhost:8089](http://localhost:8089)

    - *server*: laravel-mysql
    - *user*: root
    - *pass*: admin
    

#### Logs 
Laravel genera su propio archivo de log en `storage/logs/laravel.log`

Para verlo en tiempo real por consola, abrir otra terminal y ejecutar:  


```
$ tail -f storage/logs/laravel.log
```


## Archivos no versionados 
- `src/.env`


## Troubleshooting


## Wiki  

