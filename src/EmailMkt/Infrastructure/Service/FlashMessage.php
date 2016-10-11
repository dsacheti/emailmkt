<?php

namespace EmailMkt\Infrastructure\Service;

use Aura\Session\Segment;
use Aura\Session\Session;
use EmailMkt\Domain\Service\FlashMessageInterface;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class FlashMessage implements FlashMessageInterface
{

    /**
     * @var FlashMessenger
     */
    private $flashMessenger;

    public function __construct(FlashMessenger $flashMessenger)
    {
        $this->flashMessenger = $flashMessenger;
    }

    /**
     * @param string $name
     */
    public function setNamespace(string $name = __NAMESPACE__)
    {
        $this->flashMessenger->setNamespace($name);
        return $this;
    }

    public function setMessage($key, string $value)
    {
        switch ($key){
            case self::MESSAGE_SUCCESS:
                $this->flashMessenger->addSuccessMessage($value);
                break;
        }

        return $this;
    }

    public function getMessage($key)
    {
        $result = null;
        switch ($key){
            case self::MESSAGE_SUCCESS:
                //getCurrentSuccessMessages retorna um array
               $result = $this->flashMessenger->getCurrentSuccessMessages();
                break;
        }
        //se tem alguma coisa no array retorna o primeiro elemento, senão nulo
        return count($result)? $result[0] : null;
    }
}