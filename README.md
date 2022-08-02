
<h1 align="center">
Games Chat
</h1>

___

<h5 align="center">Back-End en Laravel realizado durante el Bootcamp FSD de GeeksHubs. Por José Carlos Núñez.</h5><br>

<p align="center">
    <a href="#about">About</a> ·
    <a href="#usage">Usage</a> ·
    <a href="#features">Features</a>
</p>

___

## About

He desarrollado un Backen-End en Laravel, el cual consiste en simular una aplicación de chat para videojuegos, con varios endpoints en las distintas tablas que pertenecen a la BBDD, con varios CRUD.

---

## Usage

Está desplegada en Heroku, por lo cual, solo tienés que utilizar los Endpoints, que se encuentran en la carpeta Postman en formato JSON y utilizarlos en Postman.

<p><strong>End-Points de Usuario</strong></p>
En primer lugar podemos ver el Login.
<p align="center">
<img src="img/login.png" width= 500><br>
<sub> Login</sub>
</p>
<br>
Register, la información de esta imagen, es la que debemos usar si queremos tener permisos de Super Admin.
<p align="center">
<img src="img/register.png" width= 500><br>
<sub> Register</sub>
</p>
<br>
<p><strong>End-Points de Super Admin y Admin</strong></p>
Añadir role de admin, para el cual debemos tener role de super Admin.
<p align="center">
<img src="img/addadmin.png" width= 500><br>
<sub> Add admin role</sub>
</p>
Eliminar role de admin, para el cual debemos tener role de super Admin.
<p align="center">
<img src="img/deleteadmin.png" width= 500><br>
<sub> Delete admin role</sub>
</p>
Añadir role de super admin, para el cual debemos tener role de super Admin.
<p align="center">
<img src="img/addsuperadmin.png" width= 500><br>
<sub>Add super admin role</sub>
</p>
Eliminar role de super admin, para el cual debemos tener role de super Admin.
<p align="center">
<img src="img/deletesuperadmin.png" width= 500><br>
<sub> Delete super admin role</sub>
</p>
<p><strong>End-Points de Juegos</strong></p>
El primer endpoint, consiste en crear un juego.
<p align="center">
<img src="img/addgame.png" width= 500><br>
<sub> Add game</sub>
</p>
Este endpoint, consiste en modificar un juego.
<p align="center">
<img src="img/updategame.png" width= 500><br>
<sub> Update game</sub>
</p>
El tercer endpoint, nos muestra todos los juegos disponibles en la BBDD.
<p align="center">
<img src="img/getgames.png" width= 500><br>
<sub> Get games</sub>
</p>
El cuarto endpoint, consiste en eliminar u un juego.
<p align="center">
<img src="img/deletegame.png" width= 500><br>
<sub> Delete game</sub>
</p>
<p><strong>End-Points de Canales</strong></p>
El primer endpoint, nos permite crear un canal.
<p align="center">
<img src="img/createchannel.png" width= 500><br>
<sub> Create channel</sub>
</p>
El segundo endpoint, nos permite eliminar un canal.
<p align="center">
<img src="img/deletechannel.png" width= 500><br>
<sub> Delete channel</sub>
</p>
El primer endpoint, nos permite unirnos a un canal.
<p align="center">
<img src="img/joinchannel.png" width= 500><br>
<sub> Join to channel</sub>
</p>
<p><strong>End-Points de Mensajes</strong></p>
El primer endpoint, nos permite crear un mensaje.
<p align="center">
<img src="img/createmessage.png" width= 500><br>
<sub> Create message</sub>
</p>
El segundo endpoint, nos permite editar un mensaje.
<p align="center">
<img src="img/editmessage.png" width= 500><br>
<sub> Edit message</sub>
</p>
El siguiente endpoint, nos muestra los mensajes que hayamos enviado mensaje.
<p align="center">
<img src="img/getmessages.png" width= 500><br>
<sub> Get message</sub>
</p>
El ultimo endpoint, nos permite eliminar un mensaje ya enviado.
<p align="center">
<img src="img/deletemessage.png" width= 500><br>
<sub> Delete message</sub>
</p>

___

##Features

<p align="center"><img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" >·<img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" >·<img src="https://img.shields.io/badge/JWT-000000?style=for-the-badge&logo=JSON%20web%20tokens&logoColor=white" >·<img src="https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=Postman&logoColor=white">·<img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white"></p>
