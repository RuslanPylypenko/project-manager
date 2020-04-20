<?php


namespace App\Model\User\UseCase\Reset\Reset;


use App\Model\Flusher;
use App\Model\User\Entity\User\UserRepository;
use App\Model\User\Service\PasswordHasher;

class Handler
{
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var Flusher
     */
    private $flusher;
    /**
     * @var PasswordHasher
     */
    private $hasher;

    public function __construct(UserRepository $users, Flusher $flusher, PasswordHasher $hasher)
    {
        $this->users = $users;
        $this->flusher = $flusher;
        $this->hasher = $hasher;
    }

    public function handle(Command $command): void
    {
        if ($user = $this->users->findByResetToken($command->resetToken)) {
            throw new \DomainException('Incorrect reset token.');
        }

        $now = new \DateTimeImmutable();

        $user->passwordReset($now, $command->passwordHash);

        $this->flusher->flush();


    }

}