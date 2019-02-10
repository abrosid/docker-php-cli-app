#!/usr/bin/env php

<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Blog\Cmd\ReadmeCommand;
use Blog\Cmd\UserCommand;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleErrorEvent;



$app = new Application("PHP console app", "0.0.1");
$readme = new ReadmeCommand();

$app->add($readme);
$app->setDefaultCommand($readme->getName());

/**
 * Handling errors by Event Dispatcher
 */
$dispatcher = new EventDispatcher();
$dispatcher->addListener(ConsoleEvents::ERROR, function(ConsoleErrorEvent $event) {
    $output = $event->getOutput();
    $command = $event->getCommand();
    if ($command) {
        $output->writeln(sprintf("An error has occured on command: <info>%s<info>", $command->getName()));
    } else {
        $output->writeln("<error>Command is not defined:<info> try to use list ");
    }
});
$app->setDispatcher($dispatcher);


/**
 * Registering CLI commands
 */
$app->add(new UserCommand());

$app->run();