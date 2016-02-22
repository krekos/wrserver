<?php

namespace App;

use Nette;
use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;


class RouterFactory
{

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList;
		$router[] = new Route('authorize/<login>/<name>', 'System:authorize');
		$router[] = new Route('install/<action>[/<id>]', array(
						'presenter' => 'Install',
						'action' => 'default'
		));
		$router[] = new Route('get/services/<clientId>', 'Get:services');
		$router[] = new Route('enter/queue/<queueId>/<clientId>', 'Set:enterQueue');
		$router[] = new Route('<action>[/<id>]', array(
						'presenter' => 'Homepage',
						'action' => 'default'
		));
		return $router;
	}

}
