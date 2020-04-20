<?php

namespace App\Model\User\Entity\User;

class User
{

    /**
     * @var Id
     */
    private $email;
    /**
     * @var Email
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

    public function __construct(Id $id, \DateTimeImmutable $date, Email $email, string $passwordHash)
    {
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->id = $id;
        $this->date = $date;
    }

    public function getEmail(): Email
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
    public function getId(): Id
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