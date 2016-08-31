<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/api/focas', 'App\Action\FocaAction:getAll');

//todo mudar para post
$app->get('/api/focas/create', 'App\Action\FocaAction:create');

//$app->get('/[{name}]', function ($request, $response, $args) {
//    // Sample log message
//    $this->logger->info("Slim-Skeleton '/' route");
//    // Render index view
//    return $this->renderer->render($response, 'index.phtml', $args);
//});

