<?php
/**
 * Created by PhpStorm.
 * User: kayo.silva
 * Date: 15/05/2018
 * Time: 21:59
 */

namespace App\Action;


use Firebase\JWT\JWT;

class AuthAction
{

    private $jwtSettings;

    public function __construct($container)
    {
        $settings = $container->get('settings');
        $this->jwtSettings = $settings["jwt"];
    }

    public function autenticate($request, $response, $args)
    {
        $key = $request->getParam("key");

        if (!$key) {
            return $response->withJson([
                "status" => "error",
                "message" => "Param [key] not found"
            ], 400);
        }

        //TODO implementar a lógica da autenticação
        $jwtToken = JWT::encode(["id" => 1, "key" => $key], $this->jwtSettings["secret"], $this->jwtSettings["algorithm"]);

        return $response->withJson(['token' => $jwtToken]);

    }

}