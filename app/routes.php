<?php
// Routes
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

$app->get('/', function ($request, $response, $args) {
    return $this->renderer->render($response, 'index.phtml', $args);
});
$app->post('/auth', 'App\Action\AuthAction:autenticate');

$app->get('/api/focas', 'App\Action\FocaAction:getAll');
$app->get('/api/focas/{id}', 'App\Action\FocaAction:getFoca');
$app->post('/api/focas/create', 'App\Action\FocaAction:create');
$app->delete('/api/focas', 'App\Action\FocaAction:delete');


//$app->get('/[{name}]', function ($request, $response, $args) {
//    // Sample log message
//    $this->logger->info("Slim-Skeleton '/' route");
//    // Render index view
//    return $this->renderer->render($response, 'index.phtml', $args);
//});

