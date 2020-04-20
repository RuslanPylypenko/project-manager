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
    /**
     * @var string
     */
    private $id;

    public function __construct(string $id, string $email, string $passwordHash)
    {
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}