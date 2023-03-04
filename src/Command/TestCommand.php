<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TestCommand extends Command
{
    protected static $defaultName = 'app:test';
    protected static $defaultDescription = 'Add a short description for your command';

    protected function configure(): void
    {
        $this
            ->setDescription('hello')
            ->setHelp('php bin/console app:test veya a:t şeklinde çalıştırılabilir.');  
            
        
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Merhaba Güzel İnsan ');
    }
}
