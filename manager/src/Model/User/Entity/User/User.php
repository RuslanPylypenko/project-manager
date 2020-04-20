<?php

namespace App\Model\User\Entity\User;

class User
{

    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $passwordHash;

    public function __construct(string $email, string $passwordHash)
    {
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }
}