<?php

namespace App\Model\User\UseCase\Reset\Reset;

use Symfony\Component\Validator\Constraints as Assert;

class Command {

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $passwordHash;

    /**
     * @var string
     * @Assert\Length(min=6)
     */
    public $resetToken;

    public function __construct(string $resetToken)
    {

        $this->resetToken = $resetToken;
    }
}