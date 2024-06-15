<?php
// Configuración de la conexión PDO
return [
    'dsn' => 'mysql:host=db;dbname=sample', // Cambia 'localhost' por 'db'
    'username' => 'sampleuser',
    'password' => 'samplepass',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];
