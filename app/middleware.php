<?php

$settings = include 'settings.php';
$settings = $settings['settings']['jwt'];
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "path" => "/api",
    "secret" => $settings["secret"],
    "algorithm" => [$settings["algorithm"]],
    "secure" => false,
    "callback" => function ($request, $response, $arguments) use ($container) {
        $container["jwt"] = $arguments["decoded"];
    },
    "error" => function ($request, $response, $arguments) {
        $data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
]));
