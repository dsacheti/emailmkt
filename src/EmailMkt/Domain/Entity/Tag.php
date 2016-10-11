<?php
declare(strict_types=1);

namespace EmailMkt\Domain\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Tag
{
    private $id;

    private $nome;

    private $customers;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

     /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function getCustomers(): Collection
    {
        return $this->customers;
    }
}