<?php

namespace App\Model\Work\UseCase\Members\Group\Remove;

use App\Model\Flusher;
use App\Model\Work\Entity\Members\Group\GroupRepository;
use App\Model\Work\Entity\Members\Group\Id;
use App\Model\Work\Entity\Members\Member\MemberRepository;

class Handler
{
    /**
     * @var GroupRepository
     */
    private $groups;
    /**
     * @var Flusher
     */
    private $flusher;
    /**
     * @var MemberRepository
     */
    private $members;

    public function __construct(GroupRepository $groups, MemberRepository $members, Flusher $flusher)
    {
        $this->groups = $groups;
        $this->flusher = $flusher;
        $this->members = $members;
    }

    public function handle(Command $command): void
    {
        $group = $this->groups->get(new Id($command->id));

        if ($this->members->hasByGroup($group->getId())) {
            throw new \DomainException('Group is not empty.');
        }

        $this->groups->remove($group);

        $this->flusher->flush();
    }
}