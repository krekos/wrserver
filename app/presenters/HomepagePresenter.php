<?php

namespace App\Presenters;

use Doctrine\ORM\Tools\SchemaTool;
use Nette;
use Tracy\Debugger;


class HomepagePresenter extends BasePresenter
{
	public function actionCreate(){

		$schemaTool = new SchemaTool($this->em);
		$classes = $this->em->getMetadataFactory()->getAllMetadata();
		$schemaTool->dropSchema($classes);
		$schemaTool->createSchema($classes);

		$this->em->beginTransaction();

		$this->em->flush();
		$this->em->commit();
		$this->flashMessage("Database Was created");
		$this->redirect('Homepage:default');
	}

	public function actionUpdate(){

		$schemaTool = new SchemaTool($this->em);
		$classes = $this->em->getMetadataFactory()->getAllMetadata();

		$schemaTool->updateSchema($classes);

		$this->em->beginTransaction();

		$this->em->flush();
		$this->em->commit();
		$this->flashMessage("Database Was created");
		$this->redirect('Homepage:default');
	}
}
