<?php

namespace App\Action;

use App\Business\UserBusiness;

/**
 * Class UserAction
 * @package App\Action
 */
class UserAction
{

    private $business;

    public function __construct(UserBusiness $business)
    {
        $this->business = $business;
    }


    public function getAll($request, $response, $args)
    {
        $users = $this->business->getUsers();
        var_dump($users);
        die();
    }

}