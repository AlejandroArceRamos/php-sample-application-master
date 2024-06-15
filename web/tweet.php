<?php

// Asegúrate de que el autoloader personalizado esté incluido
require_once __DIR__ . '/../autoloader.php';

$tweetId = $_GET["id"];
$user = $_GET["user"];

// Obtener el tweet por su ID
$tweet = (require __DIR__ . '/../dic/tweets.php')->getById($tweetId);

// Verificar si el tweet existe
if ($tweet === null) {
    http_response_code(404);
    return;
}

// Verificar si el usuario del tweet coincide con el usuario proporcionado en la URL
if ($tweet->userId !== $user) {
    // Redirigir a la URL correcta
    http_response_code(301);
    header("Location: /$tweet->userId/status/$_GET[id]");
    exit;
}

// Determinar el formato de salida y renderizar la vista adecuada
switch (require __DIR__ . '/../dic/negotiated_format.php') {
    case "text/html":
        (new Views\Layout(
            "@$_GET[user] - \"$tweet->message\"",
            new Views\Tweets\Page(
                (require __DIR__ . '/../dic/users.php')->getById($_GET["user"]),
                $tweet
            )
        ))();
        exit;

    case "application/json":
        header("Content-Type: application/json");
        echo json_encode($tweet);
        exit;
}

http_response_code(406);
