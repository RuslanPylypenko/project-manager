<?php


namespace App\Model\Work\Entity\Projects\Task;


use App\Model\Work\Entity\Members\Member\Member;
use App\Model\Work\Entity\Projects\Project\Project;

class Task
{
    /**
     * @var Id
     */
    private $id;
    /**
     * @var Project
     */
    private $project;
    /**
     * @var Member
     */
    private $author;
    /**
     * @var \DateTimeImmutable
     */
    private $date;
    /**
     * @var Type
     */
    private $type;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string|null
     */
    private $content;
    /**
     * @var int
     */
    private $progress;
    /**
     * @var int
     */
    private $priority;

    public function __construct(
        Id $id,
        Project $project,
        Member $author,
        \DateTimeImmutable $date,
        Type $type,
        int $priority,
        string $name,
        ?string $content
    )
    {
        $this->id = $id;
        $this->project = $project;
        $this->author = $author;
        $this->date = $date;
        $this->type = $type;
        $this->name = $name;
        $this->progress = 0;
        $this->content = $content;
        $this->priority = $priority;
    }

    public function edit(string $name, ?string $content): void
    {
        $this->name = $name;
        $this->content = $content;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getProject(): Project
    {
        return $this->project;
    }

    public function getAuthor(): Member
    {
        return $this->author;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function getProgress(): int
    {
        return $this->progress;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }
}