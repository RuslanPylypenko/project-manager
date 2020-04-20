<?php


namespace App\Model\User\Entity\User;


class Network
{

    /**
     * @var User
     */
    private $user;
    /**
     * @var string
     */
    private $network;
    /**
     * @var string
     */
    private $identity;

    public function __construct(
        User $user,
        string $network,
        string $identity
    )
    {
        $this->user = $user;
        $this->network = $network;
        $this->identity = $identity;
    }

    public function isForNetwork(string $network): bool
    {
       return $this->network === $network;
    }

    /**
     * @return string
     */
    public function getNetwork(): string
    {
        return $this->network;
    }

    /**
     * @return string
     */
    public function getIdentity(): string
    {
        return $this->identity;
    }


}