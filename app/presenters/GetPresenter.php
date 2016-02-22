<?php
/**
 * @author Radim Křek
 * Date: 09.02.2016
 */

namespace App\Presenters;


use App\Model\Entities\Client;
use App\Model\Entities\Queue;
use App\Model\Entities\Service;
use Nette\Application\ForbiddenRequestException;

/**
 * Presenter, pro metody, ktere budou poskytovat klientovi data
 * Class GetPresenter
 * @package App\Presenters
 */
class GetPresenter extends BasePresenter{

	/**
	 * Funkce, ktera se provede vzdy kdyz nekdo pristupuje na server a kontroluje "LOGINL
	 * @param $clientId
	 * @throws ForbiddenRequestException
	 */
	public function beforeAction($clientId){
		$this->setView('default');
		if($clientId != "admin"){
			$client = $this->em->getRepository(Client::class)->findBy(array('clientId' => $clientId));
			if(!$client){
				throw new ForbiddenRequestException;
			}
		}
	}

	/**
	 * Render funkce ktera vytahne z DB vsechny Sluzby a prevede je na XML, ktere pak da na vystup
	 * @param $clientId
	 */
	public function actionServices($clientId){
		$this->setView('default');
		$raw = $this->em->getRepository(Service::class)->findAll();
		foreach($raw as $service){
			$services[] = array_flip($service->toArray());
		}
		$xml = new \SimpleXMLElement('<wrserver/>');
		$arr = array('200' => 'code');
		array_walk_recursive($arr, array($xml, 'addChild'));
		$serv = $xml->addChild('services');
		$serv->addAttribute("count", count($services));
		foreach($services as $service){
			$s = $serv->addChild('service');
			array_walk_recursive($service, array($s, 'addChild'));
		}
		//die(var_dump($xml->asXML()));
		$this->template->xml = $xml->asXML();
	}

	/**
	 * !!NETESTOVANO!!!
	 * Render funkce ktera vrati info o Sluzbe v XML
	 * @param $id
	 */
	public function actionService($id){
		$this->setView('default');
		$raw = $this->em->getRepository(Queue::class)->find($id);
		$xml = new \SimpleXMLElement('<wrserver/>');
		array_walk_recursive(array_flip($raw->toArray(), array($xml, 'addChild')));
		$this->template->xml = $xml->asXML();
	}
}