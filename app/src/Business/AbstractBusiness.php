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


    /**
     * @param $data
     * @return \DateTime
     */
    public function converteDataBanco($data)
    {
        if ($data) {

            $data = date('d/m/Y H:i:s', strtotime($data));

            $datetime = new \DateTime();
            $arrDateTime = explode(' ', $data);
            if (array_key_exists(1, $arrDateTime)) {
                $arrTime = explode(':', $arrDateTime[1]);
                $datetime->setTime($arrTime[0], $arrTime[1], $arrTime[2]);
            }
            $arrDate = explode('/', $arrDateTime[0]);
            $datetime->setDate($arrDate[2], $arrDate[1], $arrDate[0]);
            //se tipo = 1 vai colocar a hora como 00:00:00, se 2 vai colocar como 23:59:59
            //utilizada para colocar a data inicial do dia e a data final
        }
        return $datetime;
    }


}