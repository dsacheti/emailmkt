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

    public function addTags(Collection $tags)
    {
        /** @var Tag $tag */
        foreach ($tags as $tag) {
            $tag->getCustomers()->add($this);//adiciona customer na tag
            //remove tag do customer - tags foi inicializada como uma Collection
            //e a Collection tem um método add
            $this->tags->add($tag);
        }
        return $this;
    }

    public function removeTags(Collection $tags)
    {
        /** @var Tag $tag */
        foreach ($tags as $tag) {
            $tag->getCustomers()->removeElement($this);//remove customer da tag
            //remove tag do customer - tags foi inicializada como uma Collection
            //e a Collection tem um método add
            $this->tags->removeElement($tag);
        }
        return $this;
    }

}