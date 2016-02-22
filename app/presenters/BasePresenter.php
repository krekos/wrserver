<?php
/**
 * @author Radim Křek
 * Date: 08.02.2016
 */

namespace App\Presenters;


use Kdyby\Doctrine\EntityManager;
use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter{
	/**
	 * @var  EntityManager
	 * @inject
	 */
	public $em;
}