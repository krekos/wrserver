<?php
/**
 * @author Radim Křek
 * Date: 16.02.2016
 */

namespace App\Presenters;


use Doctrine\ORM\Tools\SchemaTool;
use Kdyby\Doctrine\EntityManager;
use Nette\Application\UI\Presenter;

/**
 * Systemova trida vyuzivana pro automaticke vytvoreni (updatovani) DB prez Doctrine
 * Class InstallPresenter
 * @package App\Presenters
 */
class InstallPresenter extends Presenter{

	/** @var EntityManager @inject */
	public $em;

	/**
	 * Vytvori DB
	 * @throws \Exception
	 */
	public function renderDefault(){
		$schemaTool = new SchemaTool($this->em);
		$classes = $this->em->getMetadataFactory()->getAllMetadata();
		$schemaTool->updateSchema($classes); // php index.php orm:schema-tool:update --force

		$this->em->beginTransaction();
		$this->em->flush();
		$this->em->commit();

		$this->redirect('Homepage:default');
	}

	/**
	 * Update DB
	 * @throws \Doctrine\ORM\Tools\ToolsException
	 * @throws \Exception
	 */
	public function renderRenew(){
		$schemaTool = new SchemaTool($this->em);
		$classes = $this->em->getMetadataFactory()->getAllMetadata();

		$schemaTool->dropSchema($classes);
		$schemaTool->createSchema($classes);

		$this->em->beginTransaction();
		$this->em->flush();
		$this->em->commit();

		$this->redirect('Homepage:default');
	}
}