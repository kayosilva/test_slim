<?php

namespace App\Action;

use App\Business\FocaBusiness;
use App\Constants\GeneroConstants;
use App\Constants\StatusConstants;


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
        $data = array(
            'nome' => 'Carmenzinha',
            'genero' => GeneroConstants::FEMEA,
            'dtNascimento' => "10/07/2013",
            'status' => StatusConstants::VIVO,
            'parent_id' => 2
        );

        $result = $this->business->salvar($data);

        if (!is_array($result)) {
            return $response->withStatus(400, 'Erro ao tentar salvar os dados ' . $result);
        }

        return $response->withJSON($result);
    }
}