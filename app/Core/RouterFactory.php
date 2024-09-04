<?php

declare(strict_types=1);
namespace App\Core;

use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;

class RouterFactory
{
    public static function createRouter(): RouteList
    {
        $router = new RouteList;
        $router->addRoute('<presenter>/<action>[/<id>]', 'Home:default');
		$router->addRoute('<action>[/<id>]', 'Home:default');

        return $router;
    }
}

