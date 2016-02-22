<?php
/**
 * @author Radim Křek
 * Date: 09.02.2016
 */

namespace App\Presenters;


use App\Model\Entities\Client;
use Nette\Application\ForbiddenRequestException;
use Nette\Utils\Strings;
use Tracy\Debugger;

/**
 * Trida pro systemove funkce serveru
 * Class SystemPresenter
 * @package App\Presenters
 */
class SystemPresenter extends BasePresenter{
	/**
	 * Funkce prijme jmeno aplikace a LOGIN a vytvori nove ID nebo vytahne z DB a posle jej zpet
	 * @param $name
	 * @param $login
	 * @throws \Exception
	 */
	public function actionAuthorize($name, $login){
		$xml = new \SimpleXMLElement('<wrserver/>');
		if($login == 'testing'){
			$client = $this->em->getRepository(Client::class)->findBy(array("name" => $name));
			if(empty($client)){
				$client = new Client();
				$client->setName($name);
				$client->setClientId($this->getId($name));
				$this->em->persist($client);
				$this->em->flush();
			}

			$arr['code'] = 200;
			$arr['clientId'] = $client->getClientId();
			$arr = array_flip($arr);
			array_walk_recursive($arr, array($xml, 'addChild'));
			$this->template->xml = $xml->asXML();
		}else{
			$arr['code'] = 403;
			$arr = array_flip($arr);
			array_walk_recursive($arr, array($xml, 'addChild'));
			$this->template->xml = $xml->asXML();
		}
	}

	/**
	 * Dobudoucna neni asi potreba. stejna funkcionalita je zavedena v Autentizaci
	 * Kontrola jestli je Aplikace prihlasena.
	 * @param $clientId
	 */
	public function actionCheckConnection($clientId){
		$this->setView('authorize');
		$client = $this->em->getRepository(Client::class)->findBy(array('clientId' => $clientId));
		$res = 0;
		if(count($client) > 0){
			$res = 1;
		}
		$xml = new \SimpleXMLElement('<wrserver/>');
		$arr = array($res => 'authorized');
		array_walk_recursive($arr, array($xml, 'addChild'));
		$this->template->xml = $xml;
	}

	/**
	 * Vytvari HASH na zaklade jmena Aplikace, ktere dostane a dnesniuho datumu. Zkracuje na 10 znaku
	 * @param $name
	 * @return string
	 */
	public function getId($name){
		return substr(sha1($name . (new \DateTime())->format('d-m-Y')),0,10);
	}
}