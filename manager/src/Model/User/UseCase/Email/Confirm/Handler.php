<?php


namespace App\Model\User\UseCase\Email\Confirm;


use App\Model\Flusher;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\UserRepository;

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

    public function __construct(UserRepository $users, Flusher $flusher)
    {
        $this->users = $users;
        $this->flusher = $flusher;
    }

    public function handler(Command $command): void
    {
        $user = $this->users->get(new Id($command->id));

        $user->confirmEmailChanging($command->token);

        $this->flusher->flush();
    }

}