<?php

class Database
{
    // pdo = "php data object" para los pimpollos
    public static $pdo;
    public static $outputStatus;
    public static $connected = false;
    public static $result;


    public static function connect()
    {
        try 
        {
            $pdo = new PDO('mysql:hostname=localhost;dbname=mascotisla;charset=utf8', 'root','');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$outputStatus = "successful connection";
            self::$connected = true;
        }
        catch (PDOException $pdoException)
        {
            self::$outputStatus = "failed connection: "  . $pdoException->getMessage() . ' in ' . $pdoException->getFile() . ':' . $pdoException->getLine();
            self::$connected = false;
        }
    }

    // no es necesario porque php cierra todas las bdd al terminar el archivo pero aqui esta porsiaca
    public static function disconnect()
    {
        self::$pdo = null;
    }

    // en caso de DELETE/INSERT/UPDATE devuelve el numero de filas afectadas
    // en caso de SELECT devuelve un objeto representando una lista de todos los resultados;
    public static function execute($query)
    {
        if (!self::$connected)
        {
            self::$outputStatus = "failed execution: tried to run a query without a connection";
            return;
        }

        try
        {
            // $result->fetch() para obtener o "leer" una fila, puede ser dentro de un while (da false si no hay filas)
            // ejemplo: $row = $result->fetch(); echo $row['usuarioId'] ; imprime el id del usuario leido
            self::$result = self::$pdo->exec($query);
            self::$outputStatus = "Query successfully executed";
        }
        catch (PDOException $pdoException)
        {
            self::$outputStatus = "failed execution: "  . $pdoException->getMessage() . ' in ' . $pdoException->getFile() . ':' . $pdoException->getLine();

        }
    }
}