<?php

namespace App\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    const ROLE_USER = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * @var array
     */
    private $roles = [];

    private function __construct(array $roles)
    {
        $this->roles = $roles;
    }

    public static function createAdmin(): self
    {
        return new self([self::ROLE_ADMIN]);
    }

    public function getUsername(): string
    {
        return 'authenticated_admin';
    }

    public function getRoles(): array
    {
        $roles = $this->roles;

        $roles[] = self::ROLE_USER;

        return array_unique($roles);
    }

    public function getPassword()
    {
    }

    public function getSalt()
    {
    }

    public function eraseCredentials()
    {
    }
}
