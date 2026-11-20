# BidNow

BidNow es una plataforma web de subastas desarrollada como proyecto de tesis de la media técnica en Desarrollo de Software. Permite a los usuarios publicar productos, explorar subastas activas, realizar pujas y consultar la actividad de su cuenta.

## Funcionalidades

- Registro e inicio de sesión de usuarios.
- Autenticación mediante sesiones de PHP y contraseñas cifradas con `password_hash()`.
- Visualización de subastas activas.
- Consulta de detalles de cada subasta.
- Publicación de subastas con nombre, descripción, precio inicial, fecha de finalización e imagen.
- Registro de pujas mayores al precio actual.
- Restricción para que un usuario no pueda pujar por su propio producto.
- Finalización automática de subastas vencidas.
- Página personal con las pujas realizadas y los productos publicados.
- Cierre de sesión y eliminación de cuenta.
- Carga de imágenes en formatos JPG, JPEG, PNG y GIF.

## Tecnologías

- HTML5
- CSS3
- JavaScript
- Swiper
- Bootstrap Icons
- PHP
- MySQL / MariaDB
- phpMyAdmin

## Requisitos

- XAMPP, WAMP o un entorno local con Apache.
- PHP 8 o superior.
- MySQL o MariaDB.
- Un navegador web actualizado.

## Instalación y ejecución

1. Instala XAMPP y inicia los servicios **Apache** y **MySQL**.

2. Copia el proyecto dentro de la carpeta `htdocs` de XAMPP.

   Por ejemplo:

   ```text
   C:\xampp\htdocs\BidnowGG
   ```

3. Abre phpMyAdmin desde:

   ```text
   http://localhost/phpmyadmin
   ```

4. Crea una base de datos llamada `bidnow`.

5. Importa el archivo de base de datos incluido en el proyecto:

   ```text
   bd/bidnow.sql
   ```

6. Verifica la configuración de conexión en `php/conexion.php`:

   ```php
   mysqli_connect("localhost", "root", "", "bidnow");
   ```

   Si tu usuario o contraseña de MySQL son diferentes, actualiza esos valores.

7. Accede al proyecto desde:

   ```text
   http://localhost/BidnowGG/index.html
   ```

## Uso

1. Crea una cuenta desde la opción **Crea tu cuenta**.
2. Inicia sesión con el correo y la contraseña registrados.
3. Consulta las subastas disponibles desde el panel principal.
4. Abre los detalles de una subasta para realizar una puja.
5. Desde **Nueva subasta**, publica un producto con su imagen y fecha de finalización.
6. Revisa tus pujas y subastas desde **Mi cuenta**.
7. Cierra la sesión desde el menú lateral.

## Base de datos

El proyecto utiliza tres tablas principales:

- `usuarios`: usuarios registrados, credenciales y tipo de usuario.
- `productos`: subastas, precios, fechas, estado e imagen.
- `pujas`: historial de pujas realizadas por los usuarios.

Las subastas pueden encontrarse en estado `activa` o `finalizada`. El sistema verifica las fechas y cambia el estado de las subastas vencidas al mostrarlas desde el panel activo.

## Estructura del proyecto

```text
BidnowGG/
├── bd/
│   └── bidnow.sql
├── css/
├── img/
├── js/
├── php/
│   ├── agregar_subastas.php
│   ├── conexion.php
│   ├── dashboard.php
│   ├── detalles_subasta.php
│   ├── eliminar_cuenta.php
│   ├── iniciar_sesion.php
│   ├── mi_cuenta.php
│   ├── procesar_puja.php
│   ├── procesar_subasta.php
│   ├── registrarse.php
│   └── subastas_activas.php
├── uploads/
├── index.html
└── README.md
```

## Zona horaria

Las operaciones de subastas utilizan la zona horaria `America/Bogota`, configurada en los módulos PHP relacionados con fechas y pujas.

## Permisos

Es necesario que Apache pueda escribir en la carpeta `uploads/` para permitir la carga de imágenes de las subastas.

## GitHub Pages

El repositorio incluye un flujo de GitHub Actions que publica automáticamente el sitio en GitHub Pages al realizar cambios en la rama `main`.

GitHub Pages ofrece alojamiento para archivos estáticos. Por este motivo, la página principal, las imágenes y los estilos funcionan en Pages, pero el inicio de sesión, el registro, las pujas y la base de datos necesitan un servidor con PHP y MySQL/MariaDB, como XAMPP.

Después del primer despliegue, debes activar Pages en:

```text
Configuración > Pages > Build and deployment > Source > GitHub Actions
```

## Equipo

- Juan José
- Estiven
- Samuel
- Santiago

## Acerca del proyecto

BidNow busca ofrecer una experiencia segura, atractiva y fácil de utilizar para comprar, vender o intercambiar productos a través de subastas en línea.
