<?php

require_once __DIR__ . '/../autoloader.php';

// Obtén la configuración de la conexión PDO
$config = require __DIR__ . '/../config/db-connection.php';

// Crea la conexión PDO
$pdo = new PDO($config['dsn'], $config['username'], $config['password'], $config['options']);

// Usa la clase
use Service\UsersService;

// Crea una instancia de UsersService pasando el objeto PDO
return new UsersService($pdo);
