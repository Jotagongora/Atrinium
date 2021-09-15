# Atrinium Prueba Tecnica

## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._

Mira **Instalación** para conocer como desplegar el proyecto. Ante todo el primer paso es clonar el repositorio.

```
git clone https://github.com/Jotagongora/Atrinium
```


### Prueba Backend 📋

### Instalación 🔧

_1: Instalar XAMPP/LAMP/MAMP._

```
sudo apt install lamp-server^
```

_2: Instalar Symfony CLI para hacerlo más sencillo y el gestor de paquetes composer._

```
wget https://get.symfony.com/cli/installer -O - | bash
```
_3: Actualizar las dependencias._

```
composer update
```
```
composer install
```
_4: Una vez hecho esto, crear un archivo .env.local en la raíz del proyecto._

```
Atrinium/backend_01/.env.local
```
_5: Copia lo siguiente._

```
DATABASE_URL="mysql://tu_usuario_lamp:tu_contraseña@127.0.0.1:3306/tu_base_de_datos?serverVersion=5.7"
```

_6: Instala el framework bundle._

```
sudo apt-get install php-symfony-framework-bundle
```

_7: Crea la base de datos y sincronizala con el proyecto._

```
symfony console doctrine:migrations:migrate
```

_8: Para este proyecto, necesitarás implementar en la base de datos un usuario con el rol [ROLE_ADMIN], desde ese usuario ya podrás crear el resto desde la aplicación._ 

_9: Para finalizar ejecuta el siguiente comando para inciar el servidor._

```
symfony server:start
```

## Prueba Frontend 🛠️

## Instalación ✒️

_1: Instalar Nodejs y npm._

```
sudo apt install nodejs
```
```
sudo apt install npm
```

_2: Actualizar las dependencias en ReactJs._

```
npm install
```

_3: Inicializar el proyecto._

```
npm start
```

## Agradecer la oportunidad 🎁

_Solo quería comunicarles que he tenido que compaginar la prueba técnica con estar trabajando al mismo tiempo, y no he podido disponer de todas las horas que me hubiese gustado dedicarle,
aún así estoy satisfecho con lo que he llegado a hacer, si tienen cualquier duda o consulta, no duden en contactar conmigo a este email gongorarealjota@gmail.com.
Un cordial saludo._
