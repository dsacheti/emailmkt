<?php
declare(strict_types=1);

namespace EmailMkt\Domain\Service;

use EmailMkt\Domain\Entity\User;

interface AuthInterface
{
    public function authenticate($email,$password):bool;

    public function isAuth():bool;

    //pegar usuario na sessão
    public function getUser();

    public function destroy();
}