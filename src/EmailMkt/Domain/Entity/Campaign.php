<?php
declare(strict_types=1);

namespace EmailMkt\Domain\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Campaign
{
    private $id;

    private $name;

    private $subject;

    private $template;

    private $tags;

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
     * @return Campaign
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject(string $subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     * @return Campaign
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @param ArrayCollection $tags
     */
    public function setTags(ArrayCollection $tags)
    {
        $this->tags = $tags;
    }



    public function addTags(Collection $tags)
    {
        /** @var Tag $tag */
        foreach ($tags as $tag) {
            $tag->getCampaigns()->add($this);//adicionando a campaign na tag
            $this->tags->add($tag);//adicionando tag à campaign
        }
        return $this;
    }

    public function removeTags(Collection $tags)
    {
        /** @var Tag $tag */
        foreach ($tags as $tag) {
            $tag->getCampaigns()->removeElement($this);//removendo campaing da tag
            $this->tags->removeElement($tag);//removendo tag da campaign
        }
    }
}