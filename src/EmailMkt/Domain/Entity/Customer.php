<?php
declare(strict_types=1);

namespace EmailMkt\Domain\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Customer
{
    private $id;

    private $name;

    private $email;

    private $tags;

    /**
     * Customer constructor.
     * @param $tags
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

}