# Proyecto PHP con MySQL y Docker

Este proyecto utiliza Docker para simplificar el despliegue de una aplicación PHP con una base de datos MySQL.

## Requisitos previos

- Docker instalado en el sistema.
- Docker Compose instalado.

## Instalación y ejecución

1. En la ubicación deseada, abrir la terminal, clonar el repositorio y acceder a él con los siguientes comandos:

   ```sh
   git clone https://github.com/Nahuel296/phpTechTest.git
   cd phpTechTest
   ```

2. Si se desea, es posible modificar las variables de entorno del archivo .env.example. El archivo .env no se sube al repositorio debido a que está dentro del .gitignore.

3. Es posible levantar el proyecto utilizando make. A continuación se indica como hacerlo:

   ```sh
    make up
   ```

   Sirve para levantar los servicios (PHP y MySQL).

   ```sh
    make install
   ```

   Sirve para instalar las dependencias.

   ```sh
    make test
   ```

   Sirve para ejecutar las pruebas.

   ```sh
    make down
   ```

   Sirve para detener los servicios.

## Otros comandos útiles

```sh
 make logs
```

Sirve para ver los logs de los servicios en tiempo real.

## Alternativa a make

En caso de no utilizar make, es posible levantar el proyecto mediante las siguientes alternativas:

make up -> docker-compose up --build -d

make install -> docker-compose run --rm php composer install

make test -> docker-compose run --rm php vendor/bin/phpunit

make down -> docker-compose down

make logs -> docker-compose logs -f

## Variables de entorno

Las credenciales por defecto para MySQL son:

- Base de datos: `myapp`
- Usuario: `user`
- Contraseña: `password`

Es posible modificar estas variables en el archivo `.env` antes de levantar los contenedores.

## Archivos importantes

- `.env`: Contiene las variables de entorno del proyecto.
- `.gitignore`: Evita que archivos innecesarios se suban al repositorio.
- `docker-compose.yml`: Configuración de los servicios en Docker.
- `.env.example`: Plantilla de variables de entorno.
- `/app/tests`: Directorio que contiene las pruebas.
- `Dockerfile`: Define la imagen Docker para el entorno de ejecución de la aplicación PHP, incluyendo la instalación de dependencias y la configuración del entorno.
- `Makefile`: Automatiza tareas comunes del proyecto, como levantar y detener los contenedores, instalar dependencias y ejecutar pruebas.

## Información personal

- Nombre completo: Matías Nahuel Saad
- Localidad: Montevideo, Uruguay
- Teléfono de contacto: +598 99 560 068
- Mail: nahuelsaad3@gmail.com
