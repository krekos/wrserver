<?php
/**
 * @author Radim Křek
 * Date: 09.02.2016
 */

namespace App\Presenters;


use App\Model\Entities\Order;
use App\Model\Entities\Queue;
use App\Model\Entities\Service;
use Doctrine\DBAL\Types\Type;

/**
 * Presenter ktery bude obsahovat tridy zpracovavajici data od klienta
 * Class SetPresenter
 * @package App\Presenters
 */
class SetPresenter extends BasePresenter{

	/**
	 * Funkce, ktera se provede vzdy kdyz nekdo pristupuje na server a kontroluje "LOGIN"
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
	 * Render funkce starající se o vlozeni pozadavku na cekani do DB a vraceni vysledku prez XML
	 * @param $clientId
	 * @param $queueId
	 */
	public function renderEnterQueue($clientId, $queueId){
		$this->setView('default');
		$serviceId = $queueId;
		$service = $this->em->getRepository(Service::class)->find($serviceId);
		$queue = $this->em->getRepository(Queue::class)->findBy(array("idService" => $service));
		$date = new \DateTime();
		$date->setTime(0,0,0);

		/********** Tady to zatim nefunguje -> generoje to jen nahodne cislo poradi ************/
		//$ordersToday = $this->em->getRepository(Order::class)->createQueryBuilder('O')->select("COUNT(O.id)")->where("DATE(O.date) > :date")->setParameter("date", $date, Type::DATETIME)->getQuery()->getResult();
		$ordersToday = rand(1, 50);

		$order = new Order();
		$order->setIdQueue($queue);
		$order->setCode($ordersToday+1);
		$order->setDate(new \DateTime());
		$this->em->persist($order);
		//$this->em->flush(); //TODO 2016-20-02 Radim Křek: Odkomentovat az se to bude mit ukladat do DB

		$xml = new \SimpleXMLElement("<wrserver/>");
		$data = array_flip(array("code" => 200, "orderCode" => $order->getCode()));
		array_walk_recursive($data, array($xml, "addChild"));
		$this->template->xml = $xml->asXML();
	}
}