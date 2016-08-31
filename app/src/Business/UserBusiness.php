<?php

namespace App\Business;

/**
 * Class UserBusiness
 * @package App\Business
 */
class UserBusiness extends AbstractBusiness
{

    private $repositoryName = 'App\Entity\User';

    /**
     * Get all users
     * @return array
     */
    public function getUsers()
    {
        return $this->_em->getRepository($this->repositoryName)->findAll();
    }

    public function login($login, $pass)
    {
        try {
            if (!$login || !$pass) {
                throw new \Exception("Login ou Password não informado.");
            }


            $user = $this->_em->getRepository($this->repositoryName)
                ->findOneBy(array(
                    'login' => $login,
                    'password' => md5($pass)
                ));

            if (!$user) {
                return "Usuário não encontrado";
            }


        } catch (\Exception $e) {
            throw $e;
        }
    }
}