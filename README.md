![MascotislaLogo](/public/images/Logo.svg)
# Mascotisla
La plataforma Mascotisla es un sitio web creado como iniciativa de la fundación PIM (proteccionistas independeintes de margarita) para que el público general pueda consultar los animales de casos conocidos y detalles como su estado de salud, si está adoptado o no, etc. Así mismo la plataforma cuenta con un panel para que los miembros de la fundación puedan registrar animales, casos, y colaboradores; de la misma forma también existe un panel de administradores mediante el cual pueden gestionar y hasta eliminar animales, casos y miembros o colaboradores de ser necesario.

## Usuarios
Existen 3 posibles niveles de usuario.
- **Visitante**: es el nivel default, no requiere login, consulta limitada de la bd. Pueden existir en la bdd como "colaboradores" para guardar su información.

- **Miembro**: es un colaborador con credenciales de login, lo que le da acceso a gestionar animales y casos (solo `insert`, `update` y `select`)

- **Admin**: cuenta con todos los permisos y atributos de "miembro",  pero a su vez puede realizar `delete` y cuenta con un apartado adicional para gestionar los colaboradores. Tiene control total.


## Módulos
Para este fin el sitio web cuenta con una serie de modulos a continuación explicados

### Landing page 
El punto de entrada de todos los visitantes y usuarios por igual. Cuenta con las siguientes opciones 
`Consulta animales`: Este botón lleva a la vista dedicada a los visitantes.
`Contactanos`: lleva al footer.
`Inicia sesion': lleva a la vista de login.

### Animales y Casos
Permite registrar, editar y consultar (y eliminar si se es administrador)

### Colaboradores
Panel de gestión solo disponible para los administradores 


## Estructura del proyecto
(las carpetas vacias (marcadas con *) no aparecerán en el repo)
  
```bash
Mascotisla
├───app                    // funcionalidad de la aplicacion, oculto al navegador (en teoria)
│   ├───data               // Base de datos
│   ├───includes           // Archivos que se insertan en otros sitios para traer funcionalidad
│   │   ├───classes        // Clases con las entidades y utilidades del programa
│   │   ├───formLogic      // Archivos con la logica para manejar los formularios
│   │   └───tableLogic     // Archivos con la logica para generar las tablas
│   └───templates          // Codigo html reutilizable con secciones completas
│       ├───forms          // Formularios para introducir informacion
│       └───tables         // Tablas para mostrar informacion
└───public                 // Archivos estaticos visibles para el navegador 
    ├───images             // Imagenes y vectores
    ├───pages              // Las diferentes paginas/vistas/modulos de la aplicacion
    ├───scripts            // Archivos de javascript para brindar interactividad
    └───styles             // CSS para alterar la apariencia de ciertas cosas
```
## Sobre el codigo
- Se requiere php 7.0 como mínimo
- Se requiere un servidor web como Apache

### Sobre el idioma
Si bien los elementos visibles de la interfaz estan en español el codigo es en ingles por consistencia

### El nombrado de archivos
Los archivos se están nombrando de dos formas principales segun su funcion
`nombreDelArchivo.html.php` si el archivo es principalmente código HTML (con una que otra etiqueta php para incluir o generan más html).
`nombreDelArchivo.php` si el archivo es principalmente código PHP que otorga funcionalidad y lógica a la aplicación.

Por ejemplo: 

`login.html.php` tiene todo el HTML para la esttructura y deseño del inicio de sesión.

`login.php` tiene toda la lógica que hace funcionar el login y procesa los datos enviados para dar una respuesta.

## Clases

### User
Esta clase representa a un usuario en el sistema. Almacena información personal como ID, nombre, apellido, dirección, identificación, correo electrónico y contraseña. Además, incluye dos propiedades booleanas: `isMember` para indicar si el usuario es miembro y isAdmin para determinar si tiene privilegios de administrador. La clase incluye un constructor para inicializar todas las propiedades y métodos getter y setter para acceder y modificar cada una de ellas, con una lógica específica para `isAdmin` que asegura que un usuario solo puede ser administrador si es miembro.

### NotificacionAdmin
La clase NotificacionAdmin gestiona las notificaciones dirigidas a los administradores. Cada notificación tiene un ID, título, mensaje, fecha y un estado leida (indicando si ha sido leída o no). Esta clase interactúa directamente con la base de datos a través de métodos estáticos:

`obtenerTodas()`: Recupera todas las notificaciones o solo las no leídas, ordenadas por fecha.

`crear()`: Inserta una nueva notificación en la base de datos.

`marcarComoLeida()`: Actualiza el estado de una notificación a "leída" dado su ID.
Depende de la clase Database para sus operaciones de persistencia.

### Database
Es una clase creada para simplificae el manejo de la bdd a traves de un PDO (php data object), tiene metodos como `Database::connect()` para conectarse a la bdd y manejar posibles errores.
el estado de la conexion (sea exitosa o fallida) se almacena en la variable `$outputStatus`, de la misma forma que `$connected` representa el estado de la conexion mediante `true` o `false`.
La clase tambien cuenta con un metodo `Database::disconnect()` para desconectarse manualmente, aunque no es necesario ya que por defecto **php cierra todas las conexiones a bdds al terminar el archivo**.

Para la consulta a la bdd de sentencias `DELETE`, `INSERT`, `UPDATE` se ha implementado el metodo `Database::execute($query)` que guarda su resultado en la variable `$result`, devuelve el numero de filas afectadas.

Para la consulta a la bdd de sentencias `SELECT` se ha implementado el metodo `Database::executeQuery($query)` que guarda su resultado en la variable `$result`, devuelve un **objeto representando un array de todos los resultados** en el cual podemos usar el primer indice para indicar la fila y el segundo indice para el nombre de la columna
```php
Database::connect();
echo Database::$outputStatus; // verificar si se ha conectado
$consulta = 'SELECT * FROM animales'
Database::executeQuery($consulta);
$primerAnimal = Database::$result[0]; // tomar el primer animal, el fetch se puede hacer dentro de un while
echo $primerAnimal['nombre'];
```

Para consultas en donde el usuario deba introducir parametro se debe utilizar la función `Database::safeExecute($query, $valuesArray)`. Esta función toma una consulta preparada con signos de interrogación como `SELECT * FROM colaboradores WHERE nombre LIKE ?;` y la prepara reemplazando los ? por su valor correspondiente en un arreglo de valores, por ejemplo:
```php
$query = "INSERT INTO colaboradores(nombre,cedula) VALUES (?,?);";
Database::safeExecute($query, [$name, $cedula]);
echo Database::$result // 1 fila insertada
```
esta función esta hecha para devolver un arreglo si es `SELECT` o el número de filas afectadas de ser `INSERT, UPDATE, DELETE`

Esto se hace para prevenir que el usuario haga un ataque de inyección sql, por ejemplo introduciendo `DROP TABLE colaboradores; --` en el campo del nombre

