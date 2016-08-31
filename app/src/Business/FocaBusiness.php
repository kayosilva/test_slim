<?php

namespace App\Business;

/**
 * Class FocaBusiness
 * @package App\Business
 */
class FocaBusiness extends AbstractBusiness
{
    /**
     * @var \App\Entity\Foca
     */
    private $repositoryName = '\App\Entity\Foca';


    /**
     * @param \App\Entity\Foca $entity
     * @return array
     */
    private function parseEntity(\App\Entity\Foca $entity)
    {
        $data = [
            'id' => $entity->getId(),
            'nome' => $entity->getNome(),
            'genero' => $entity->getGenero(),
            'dtNascimento' => $entity->getDtNascimento(),
            'dtCadastro' => $entity->getDtCadastro(),
            'status' => $entity->getStatus(),
            'parent' => [],
            'children' => [],
        ];

        if ($entity->getParent()) {
            $data['parent'] = $this->parseEntity($entity->getParent());
            unset($data['parent']['children']);
            unset($data['parent']['parent']);
        }

        if ($entity->getChildren()) {
            foreach ($entity->getChildren() as $k => $child) {
                $data['children'][$k] = $child->__toArray();
                unset($data['children'][$k]['parent'], $data['children'][$k]['children']);
            }

        }

        return $data;
    }

    /**
     * @param array $params
     * @param array $orderBy
     * @param null $limit
     * @param null $offset
     * @return array
     */
    public function getFocas(array $params = [], array $orderBy = ['nome' => 'asc'], $limit = null, $offset = null)
    {
        $focas = $this->_em->getRepository($this->repositoryName)->findBy($params, $orderBy, $limit, $offset);
        if ($focas) {
            foreach ($focas as $key => $foca) {
                $focas[$key] = $this->parseEntity($foca);

            }
        }
        unset($foca);
        return $focas;

    }

    /**
     * @param $id
     * @return null|object
     */
    public function getFocaById($id)
    {
        return $this->_em->getRepository($this->repositoryName)->find($id);
    }

    /**
     * @param array $data
     * @return null|object|string
     */
    public function salvar(array $data)
    {
        try {
            //instancia a entity
            $entity = new $this->repositoryName;

            //verifica se o id foi passado
            if (array_key_exists('id', $data) && !empty($data['id'])) {
                //busca o registro
                $entity = $this->getFocaById($data['id']);
                //se não encontrou o registro gera um exception
                if (!$entity) {
                    throw new \Exception("Foca não encontrada com o id: " . $data['id']);
                }
            }

            //seta os parametros na entity
            $entity->setNome($data['nome'])
                ->setDtNascimento($this->converteDataBanco($data['dtNascimento']))
                ->setGenero($data['genero'])
                ->setStatus($data['status'])
                ->setDtCadastro($entity->getDtCadastro());

            //verifica se foi passado o id do pai da foca
            if (array_key_exists('parent_id', $data) && !empty($data['parent_id'])) {
                //seta a referencia na entity
                $entity->setParent($this->_em->getReference($this->repositoryName, $data['parent_id']));
            }

            //persiste os dados
            $this->_em->persist($entity);
            $this->_em->flush();

            return $this->parseEntity($entity);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}