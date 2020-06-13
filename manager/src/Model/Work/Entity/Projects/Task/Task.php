<?php


namespace App\Model\Work\Entity\Projects\Task;


use App\Model\Work\Entity\Members\Member\Member;
use App\Model\Work\Entity\Projects\Project\Project;
use Webmozart\Assert\Assert;

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

    private $parent;

    private $planDate;

    private $status;

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
        $this->status = Status::new();

    }

    public function edit(string $name, ?string $content): void
    {
        $this->name = $name;
        $this->content = $content;
    }

    public function setChildOf(?Task $parent): void
    {
        if ($parent) {
            $current = $parent;
            do {
                if ($current === $this) {
                    throw new \DomainException('Cyclomatic children.');
                }
            }
            while ($current && $current = $current->getParent());
        }

        $this->parent = $parent;
    }

    public function plan(?\DateTimeImmutable $date): void
    {
        $this->planDate = $date;
    }

    public function move(Project $project): void
    {
        if ($project === $this->project) {
            throw new \DomainException('Project is already same.');
        }
        $this->project = $project;
    }

    public function changeType(Type $type): void
    {
        if ($this->type->isEqual($type)) {
            throw new \DomainException('Type is already same.');
        }
        $this->type = $type;
    }

    public function changeStatus(Status $status): void
    {
        if ($this->status->isEqual($status)) {
            throw new \DomainException('Status is already same.');
        }
        $this->status = $status;
    }

    public function changeProgress(int $progress): void
    {
        Assert::range($progress, 0, 100);
        if ($progress === $this->progress) {
            throw new \DomainException('Progress is already same.');
        }
        $this->progress = $progress;
    }

    public function isNew(): bool
    {
        return $this->status->isNew();
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

    public function getPlanDate(): ?\DateTimeImmutable
    {
        return $this->planDate;
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

    public function getParent(): ?Task
    {
        return $this->parent;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }
}