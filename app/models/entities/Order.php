<?php
/**
 * @author Radim Křek
 * Date: 08.02.2016
 */

namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;
use Kdyby\Doctrine\Entities\Attributes\Identifier;
use Kdyby\Doctrine\Entities\MagicAccessors;

/**
 * Class Order
 * @package App\Model\Entities
 * @ORM\Entity
 * @ORM\Table orders
 */
class Order extends BaseEntity{
	use MagicAccessors;
	use Identifier;

	/**
	 * @var Queue
	 * @ORM\ManyToOne(targetEntity="Queue", inversedBy="id")
	 */
	public $idQueue;

	/**
	 * @var varchar;
	 * @ORM\Column(type="string")
	 */
	public $code;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetime")
	 */
	public $date;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="time")
	 */
	public  $start;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="time")
	 */
	public $end;

	/**
	 * @var bool
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	public $userConf;

	/**
	 * @var bool
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	public $providerConf;

	/**
	 * @var bool
	 * @ORM\Column(type="boolean")
	 */
	public $empty;
}