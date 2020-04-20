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
    /**
     * @var \DateTimeImmutable
     */
    private $date;

    public function __construct(string $id, \DateTimeImmutable $date, string $email, string $passwordHash)
    {
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->id = $id;
        $this->date = $date;
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

    /**
     * @return \DateTimeImmutable
     */
    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }
}