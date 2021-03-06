<?php


namespace App\Model\Work\UseCase\Projects\Task\Files\Add;

use App\Model\Flusher;
use App\Model\Work\Entity\Members\Member\Id as MemberId;
use App\Model\Work\Entity\Members\Member\MemberRepository;
use App\Model\Work\Entity\Projects\Task\File\Id as FileId;
use App\Model\Work\Entity\Projects\Task\File\Info;
use App\Model\Work\Entity\Projects\Task\Id;
use App\Model\Work\Entity\Projects\Task\TaskRepository;

class Handler
{
    private $members;
    private $tasks;
    private $flusher;

    public function __construct(MemberRepository $members, TaskRepository $tasks, Flusher $flusher)
    {
        $this->members = $members;
        $this->tasks = $tasks;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $member = $this->members->get(new MemberId($command->member));
        $task = $this->tasks->get(new Id($command->id));

        foreach ($command->files as $file) {
            $task->addFile(
                FileId::next(),
                $member,
                new \DateTimeImmutable(),
                new Info(
                    $file->path,
                    $file->name,
                    $file->size
                )
            );
        }

        $this->flusher->flush();
    }
}