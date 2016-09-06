<?php

namespace App\Action;

use App\Business\FocaBusiness;


/**
 * Class FocaAction
 * @package App\Action
 */
class FocaAction
{
    private $business;

    public function __construct(FocaBusiness $business)
    {
        $this->business = $business;
    }

    public function getAll($request, $response, $args)
    {
        $result = $this->business->getFocas();
        return $response->withJSON($result);
    }

    public function create($request, $response, $args)
    {
        $data = $request->getParams();
        $result = $this->business->salvar($data);

        if (!is_array($result)) {
            return $response->withJson('Erro ao tentar salvar os dados ' . $result, 400);
        }

        return $response->withJSON($result);
    }

    public function delete($request, $response, $args)
    {
        $id = $request->getParam('id');

        $result = $this->business->deletar($id);
        if (!is_bool($result)) {
            return $response->withJson($result, 400);
        }
        return $response->withJson("Registro removido.", 204);

    }
}