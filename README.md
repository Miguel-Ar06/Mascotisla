![MascotislaLogo](/public/images/Logo.svg)
# Mascotisla
La plataforma Mascotisla es un sitio web creado como iniciativa de la fundación PIM (proteccionistas independeintes de margarita) para que el público general pueda consultar los animales de casos conocidos y detalles como su estado de salud, si está adoptado o no, etc. Así mismo la plataforma cuenta con un panel para que los miembros de la fundación puedan registrar animales, casos, y colaboradores; de la misma forma también existe un panel de administradores mediante el cual pueden gestionar y hasta eliminar animales, casos y miembros o colaboradores de ser necesario.

## Estructura del proyecto
(las carpetas vacias (*) no aparecerán en el repo)
  
```bash
└───Mascotisla
    ├───app              // funcionalidad oculta al navegador
    │   ├───data            // Archivos de bdd o similar
    │   ├───includes        // Archivos pensados para incrustrar,  ofrecen funcionalidad
    │   └───templates       // Archivos con html generico para llenar con informacion
    └───public           // Archivos accesibles para el navegador, como el index
        ├───images          // imagenes, vectores, etc
        ├───pages           // Las distintas paginas o vistas, suelen contener los includes
        ├───scripts*        // javascript para funcionalidades
        └───styles          // css para los estilos
```
## Consideraciones importantes para el codigo
Si bien los elementos visibles de la interfaz estan en español el codigo es en ingles por consistencia

### La clase Database
```php
class Database {}
```
Es una clase creada para simplificae el manejo de la bdd a traves de un PDO (php data object), tiene metodos como `Database::connect()` para conectarse a la bdd y manejar posibles errores.
el estado de la conexion (sea exitosa o fallida) se almacena en la variable `$outputStatus`, de la misma forma que `$connected` representa el estado de la conexion mediante `true` o `false`.
La clase tambien cuenta con un metodo `Database::disconnect()` para desconectarse manualmente, aunque no es necesario ya que por defecto **php cierra todas las conexiones a bdds al terminar el archivo**.

Para la consulta a la bdd se ha implementado el metodo `Database::execute($query)` que guarda su resultado en la variable `$result`. Este metodo puede:
- devolver el **numero de filas afectadas** para sentencias como `DELETE`, `INSERT`, `UPDATE`
- devolver un **objeto representando todos los resultados** en el caso de `SELECT`. En dicho caso podemos usar su metodo `->fetch()` para **leer una fila**, por ejemplo
```php
Database::connect();
echo Database::$outputStatus; // verificar si se ha conectado
$consutla = 'SELECT * FROM animales'
Database::execute($consulta);
$primerAnimal = Database::$result->fetch(); // tomar el primer animal, el fetch se puede hacer dentro de un while
echo $primerAnimal['nombre'];
```
