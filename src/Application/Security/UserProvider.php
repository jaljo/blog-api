<?php

namespace App\Application\Security;

use App\Domain\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
    }

    public function refreshUser(UserInterface $user)
    {
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}
