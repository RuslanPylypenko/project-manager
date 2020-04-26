<?php


namespace App\Command\User;

use App\Model\User\Entity\User\Role as RoleValue;
use App\Model\User\UseCase\Role;
use App\Model\User\UseCase\Role\Handler;
use App\ReadModel\User\UserFetcher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RoleCommand extends Command
{

    /**
     * @var UserFetcher
     */
    private $users;
    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var Handler
     */
    private $handler;

    public function __construct(UserFetcher $users, ValidatorInterface $validator, Handler $handler)
    {
        parent::__construct();
        $this->users = $users;
        $this->validator = $validator;
        $this->handler = $handler;
    }

    public function configure()
    {
        $this
            ->setName('user:role')
            ->setDescription('Changes user role');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        $email = $helper->ask($input, $output, new Question('Email: '));

        if (!$user = $this->users->findByEmail($email)) {
            throw new \LogicException('User is not found.');
        }

        $command = new Role\Command($user->id);

        $roles = [RoleValue::USER, RoleValue::ADMIN];
        $command->role = $helper->ask($input, $output, new ChoiceQuestion('Role: ', $roles, 0));

        $violations = $this->validator->validate($command);

        if ($violations->count()) {
            foreach ($violations as $violation) {
                $output->writeln('<error>' . $violation->getPropertyPath() . ': ' . $violation->getMessage() . '</error>');
            }
            return;
        }

        $this->handler->handle($command);

        $output->writeln('<info>Done!</info>');
    }
}