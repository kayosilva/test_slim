<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity de Focas
 * @author Kayo Oliveira <kayo.oliveiras2@gmail.com>
 * @ORM\Entity
 * @ORM\Table(name="foca")
 */
class Foca
{

    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    protected $nome;

    /**
     * @var string
     * @ORM\Column(type="string", length=1)
     */
    protected $genero;

    /**
     * @var date
     * @ORM\Column(type="date", name="dt_nasc")
     */
    protected $dtNascimento;

    /**
     * @var datetime
     * @ORM\Column(type="datetime", name="dt_cad", options={"default" : "CURRENT_TIMESTAMP"})
     */
    protected $dtCadastro;

    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    protected $status;

    /**
     * @var Foca
     * @ORM\ManyToOne(targetEntity="Foca", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    protected $parent;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Foca", mappedBy="parent")
     */
    private $children;

    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Foca
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return Foca
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @param string $genero
     * @return Foca
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDtNascimento()
    {
        return $this->dtNascimento;
    }

    /**
     * @param \DateTime $dtNascimento
     * @return Foca
     */
    public function setDtNascimento($dtNascimento)
    {
        $this->dtNascimento = $dtNascimento;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDtCadastro()
    {
        return $this->dtCadastro;
    }

    /**
     * @param \DateTime $dtCadastro
     * @return Foca
     */
    public function setDtCadastro($dtCadastro)
    {
        $this->dtCadastro = $dtCadastro ? $dtCadastro : new \DateTime();
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Foca
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Foca $parent
     * @return Foca
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param mixed $children
     * @return Foca
     */
    public function setChildren($children)
    {
        $this->children = $children;
        return $this;
    }


    /**
     * @return array
     */
    public function __toArray()
    {
        $data = [];
        foreach ($this as $k => $v) {
            $data[$k] = $v;
        }

        return $data;
    }

}