<?php


namespace App\Model\Work\Entity\Projects\Project;


use App\Model\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class ProjectRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var EntityRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repo = $em->getRepository(Project::class);
        $this->em = $em;
    }

    public function get(Id $id): Project
    {
        /** @var Project $project */
        if (!$project = $this->repo->find($id->getValue())) {
            throw new EntityNotFoundException('Project is not found.');
        }
        return $project;
    }

    public function add(Project $project): void
    {
        $this->em->persist($project);
    }

    public function remove(Project $project): void
    {
        $this->em->remove($project);
    }
}