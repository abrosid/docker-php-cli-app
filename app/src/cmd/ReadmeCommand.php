<?php
namespace Blog\Cmd;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReadmeCommand extends Command {
    protected function configure() {
        $this->setName("readme")->setDescription("Readme");
    }
    protected function execute(InputInterface $in, OutputInterface $output) {
        $output->writeln("This is the default command for test");
    }
}