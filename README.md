# Requerimientos
- Entorno xampp o lammp
	- Apache (PHP)
	- MySQL
- Composer
- Nodejs
 
# Instalacion del Proyecto

## Clonado del repositorio
```
cd C:\xampp\htdocs
git clone https://github.com/GabrielManzanilla/MujerTransformadora.git

cd MujerTransformadora
composer install

cp .env.example .env
```

Es importante modificar en el .env creado los datos correspondientes a la base de datos y descomentar las lineas de codigo

## Configuracion de la base de datos
~~~
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_bd
DB_USERNAME=root
DB_PASSWORD=
~~~

Posteriormente se debe ejecutar los sigueintes comandos para que el sistema genere los archivos necesarios.

```
php artisan key:generate
php artisan migrate
```
>[!Note] Estos se encargan de generar su clave unica y de realizar la construccion de la db con la migracion


## Creacion de estilos con node
Para finalizar es necesario cargar los recursos de node
```
npm install
npm run build 
```

# Ejecucion del sistema

## Acceso al sitio web
En las configuraciones de `C:\xampp\apache\conf\httpd.conf`
~~~
Listen 0.0.0.0:80
Requiere all grated
~~~
xampp fue configurado para que cualquier equipo en la red pueda ver la pagina para esto se ejecuta el comando:
 ```
 ipconfig
 ```

 se registra la ip obtenida y se abre desde cualquier equipo en la misma red de la siguiente forma

 _http://__IP__/MujerTransformadora/public_ 

## Activacion de entorno de produccion
En el archivo ==.env== cambiar:

~~~
APP_ENV=production
APP_DEBUG=false
~~~
y ejecutar :
~~~
php artisan config:clear
php artisan cache:clear
~~~
para que Laravel obtenga los nuevos valores

# Actualizacion de cambios
Para obtener los cambios realizados en este repositorio (y si ya esta clonado) unicamente es necesario ejecutar el siguiente comando.
```
cd C:\xampp\htdocs\MujerTransformadora
git pull
```