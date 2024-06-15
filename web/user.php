<?php

require_once __DIR__ . '/../autoloader.php';

if (!isset($_GET['user'])) {
    http_response_code(400);
    echo 'Bad Request: Missing user parameter';
    exit;
}

$userId = $_GET['user'];

$userService = require __DIR__ . '/../dic/users.php';
$user = $userService->getById($userId);

if ($user === null) {
    http_response_code(404);
    echo 'User not found';
    exit;
}

$tweetsService = require __DIR__ . '/../dic/tweets.php';
$tweets = $tweetsService->getLastByUser($userId);
$tweetsCount = $tweetsService->getTweetsCount($userId);

(new Views\Layout(
    "@$userId",
    new Views\Tweets\Listing($user, $tweets, $tweetsCount)
))();
