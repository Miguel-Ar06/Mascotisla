<?php

class Database
{
    // pdo = "php data object" para los pimpollos
    public static $pdo;
    public static $outputStatus;
    public static $connected = false;
    public static $result;
    public static $executionSuccessful = false;

    public static function connect()
    {
        try 
        {
            self::$pdo = new PDO('mysql:hostname=localhost;dbname=debugbdd;charset=utf8', 'root','');
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

    // funcion para ejecutar consultas sin chequeo, devuelve el numero de filas afectadas
    public static function execute($query)
    {
        if (!self::$connected)
        {
            self::$outputStatus = "failed execution: tried to run a query without a connection";
            self::$executionSuccessful = false;
            return;
        }

        try
        {
            self::$result = self::$pdo->exec($query);
            self::$outputStatus = "Query successfully executed";
            self::$executionSuccessful = true;

        }
        catch (PDOException $pdoException)
        {
            self::$outputStatus = "failed execution: "  . $pdoException->getMessage() . ' in ' . $pdoException->getFile() . ':' . $pdoException->getLine();

        }
    }

    // funcion para los SELECT sin chequeo: devuelve un objeto representando una lista de todos los resultados, guardado en $result;
    public static function executeQuery($query)
    {
        if (!self::$connected)
        {
            self::$outputStatus = "failed execution: tried to run a query without a connection";
            self::$executionSuccessful = false;
            return;
        }

        try
        {
            self::$result = self::$pdo->query($query)->fetchAll();
            self::$outputStatus = "SELECT query successfully executed";
            self::$executionSuccessful = true;

        }
        catch (PDOException $pdoException)
        {
            self::$outputStatus = "failed execution: "  . $pdoException->getMessage() . ' in ' . $pdoException->getFile() . ':' . $pdoException->getLine();

        }
    }

    // funcion para ejecutar consultas preparadas de forma segura donde el usuario debe introducir datos
    // devuelve el numero de filas afectadas
    // ejemplo query: "UPDATE users SET email = ? WHERE id = ?" -- los ? son espacios seguros para introducir informacion
    // ejemplo valuesArray: [$emailUsuario, $idUsuario] -- el orden importa, debe alinearse con los signos de interrogacion
    public static function safeExecute($query, $valuesArray)
    {
        $preparedQuery = self::$pdo->prepare($query);

        try 
        {
            $preparedQuery->execute($valuesArray);
            // devolver el conteo o la lista si es select
            if (stripos(trim($query), 'SELECT') === 0) 
            {
                self::$result = $preparedQuery->fetchAll();
            } 
            else 
            {
                self::$result = $preparedQuery->rowCount(); // affected rows
            }
            self::$outputStatus = "Safe query successfully executed";
        } 
        catch (PDOException $pdoException)
        {
            self::$outputStatus = "failed execution: "  . $pdoException->getMessage() . ' in ' . $pdoException->getFile() . ':' . $pdoException->getLine();

        }
    }
}