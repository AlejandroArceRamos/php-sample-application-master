<?php

require_once __DIR__ . '/../autoloader.php';

// Obtén el segmento de la URL después del dominio
$requestUri = $_SERVER['REQUEST_URI'];
$segments = explode('/', trim($requestUri, '/'));

// Si la URL tiene al menos un segmento
if (!empty($segments[0])) {
    // El primer segmento es el nombre de usuario
    $userId = $segments[0];

    // Obtener el usuario por su ID
    $userService = require __DIR__ . '/../dic/users.php';
    $user = $userService->getById($userId);

    if ($user !== null) {
        // Obtener los tweets del usuario
        $tweetsService = require __DIR__ . '/../dic/tweets.php';
        $tweets = $tweetsService->getLastByUser($userId);
        $tweetsCount = $tweetsService->getTweetsCount($userId);

        // Renderizar la vista de los tweets del usuario
        (new Views\Layout(
            "@$userId",
            new Views\Tweets\Listing($user, $tweets, $tweetsCount)
        ))();
        exit;
    }
}

// Si la URL no coincide con ninguna ruta conocida, mostrar la página de inicio
(new Views\Layout(
    "Twitter - Newcomers",
    new Views\Users\Listing((require __DIR__ . '/../dic/users.php')->getLastJoined()),
    true
))();
