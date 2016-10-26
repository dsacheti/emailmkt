<?php
declare(strict_types=1);

namespace EmailMkt\Domain\Service;

interface FlashMessageInterface
{
    const MESSAGE_SUCCESS = 0;
    //a variável mágina __NAMESPACE__ vai pegar o namespace da interface
    public function setNamespace(string $name);

    public function setMessage($key,string $value);

    public function getMessage($key);
}