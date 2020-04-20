<?php

namespace App\Model\User\UseCase\Reset\Reset;

class Command {

    /**
     * @var string
     */
    public $passwordHash;

    /**
     * @var string
     */
    public $resetToken;

    public function __construct(string $resetToken)
    {

        $this->resetToken = $resetToken;
    }
}