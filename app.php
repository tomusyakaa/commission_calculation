<?php

declare(strict_types=1);

require './app/bootstrap.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (!$argv[1]) {
    throw new Exception("No datafile provided.");
}

$command = new \App\Classes\Command\CalculateCommissionsCommand();

if ($command instanceof \App\Classes\Command\ExecutableInterface) {
    $command->execute($argv[1]);
}