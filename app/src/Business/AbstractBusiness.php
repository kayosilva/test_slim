<?php

namespace App\Business;

use Doctrine\ORM\EntityManager;

/**
 * Class AbstractBusiness Classe abstrata com métodos comuns a todas as classes de negocio
 * @package App\Business
 */
abstract class AbstractBusiness
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $_em = null;

    public function __construct(EntityManager $entityManager)
    {
        $this->_em = $entityManager;
    }
}