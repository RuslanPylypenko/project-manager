<?php

namespace App\Model\User\Entity\User;

class User
{
    private const STATUS_WAIT = 'wait';
    private const STATUS_ACTIVE = 'active';

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
    /**
     * @var string
     */
    private $confirmToken;

    /**
     * @var string
     */
    private $status;

    public function __construct(
        Id $id,
        \DateTimeImmutable $date,
        Email $email,
        string $passwordHash,
        string $confirmToken
    )
    {
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->id = $id;
        $this->date = $date;
        $this->confirmToken = $confirmToken;
        $this->status = self::STATUS_WAIT;
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
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

    /**
     * @return null|string
     */
    public function getConfirmToken(): ?string
    {
        return $this->confirmToken;
    }
}