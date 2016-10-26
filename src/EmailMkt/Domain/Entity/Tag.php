<?php

namespace EmailMkt\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Tag
{
    private $id;

    private $nome;

    private $customers;

    private $campaigns;

    /**
     * Tag constructor.
     */
    public function __construct()
    {
        $this->customers = new ArrayCollection();
        $this->campaigns = new ArrayCollection();
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
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCustomers():Collection
    {
        return $this->customers;
    }


    public function getCampaigns():Collection
    {
        return $this->campaigns;
    }
}