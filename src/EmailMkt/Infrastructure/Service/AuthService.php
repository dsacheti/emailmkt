<?php

namespace EmailMkt\Infrastructure\Service;

use EmailMkt\Domain\Entity\User;
use EmailMkt\Domain\Service\AuthInterface;
use Zend\Authentication\Adapter\ValidatableAdapterInterface;
use Zend\Authentication\AuthenticationService;

class AuthService implements AuthInterface
{

    /**
     * @var AuthenticationService
     */
    private $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function authenticate($email, $password): bool
    {
        /** @var ValidatableAdapterInterface $adapter */
        $adapter = $this->authenticationService->getAdapter();
        $adapter->setIdentity($email);
        $adapter->setCredential($password);
        //chama os dados e autentica o usuário devolvendo o resultado
        $result = $this->authenticationService->authenticate();
        return $result->isValid();
    }

    public function isAuth():bool
    {
        return $this->getUser() != null;
    }

    public function getUser()
    {
        //getIdentity neste caso vai retornar a entidade user
        return $this->authenticationService->getIdentity();
    }

    public function destroy()
    {
        $this->authenticationService->clearIdentity();
    }
}