<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;

		//backend routes
        $router->addRoute('administration/login', 'Backend:Login:default');
        $router->addRoute('administration', 'Backend:Homepage:default');

        //frontend routes
        $router->addRoute('', 'Frontend:Homepage:default');

        $router->addRoute('<presenter>/<action>[/<id>]', 'Frontend:Homepage:default');
		return $router;
	}
}
