<?php


namespace App\Command;


use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

class DecoratorCommand extends AbstractMaker
{
    /**
     * @inheritDoc
     */
    public static function getCommandName(): string
    {
        return 'make:decorator';
    }
    public function configureCommand(Command $command, InputConfiguration $inputConf)
    {
        $command
            ->setDescription('Creates a new decorator class')
            ->addArgument('decorator-class', InputArgument::OPTIONAL, sprintf('Choose a name for your decorator class (e.g. <fg=yellow>%sDecorator</>)', Str::asClassName(Str::getRandomTerm())))
//            ->setHelp(file_get_contents(__DIR__.'/../Resources/help/MakeDecorator.txt'))
        ;
    }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator)
    {

        $decoratorClassNameDetails = $generator->createClassNameDetails(
            $input->getArgument('decorator-class'),
            'Decorator\\',
            'Decorator'
        );

        $generator->generateClass(
            $decoratorClassNameDetails->getFullName(),
            __DIR__.'/../Resources/skeleton/decorator/Decorator.tpl.php',
            [
                'methods' => [
                    0 => [
                        'name' => 'getName',
                        'args' =>  [
                            0 => [
                                'type' => 'string',
                                'value' => '$name',
                            ],
                            1 => [
                                'type' => 'int',
                                'value' => '$name2',
                            ],
                        ],
                        'return_type_hint' => 'string',
                    ],
                    1 => [
                        'name' => 'getValue',
                        'args' => [],
                        'return_type_hint' => 'int',
                    ],
                ]
            ]
        );

        $generator->writeChanges();

        $this->writeSuccessMessage($io);
        $io->text('Next: Open your new decorator class and add some pages!');
    }

    public function configureDependencies(DependencyBuilder $dependencies)
    {
    }
}