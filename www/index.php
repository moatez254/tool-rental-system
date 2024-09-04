<?php
 
 // www/index.php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$bootstrap = App\Bootstrap::boot();
$container = $bootstrap->createContainer();

$container->getByType(Nette\Application\Application::class)
          ->run();
