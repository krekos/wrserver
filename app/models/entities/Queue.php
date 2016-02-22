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
 * Class Queue
 * @package App\Model\Entities
 * @ORM\Entity
 * @ORM\Table queues
 */
class Queue extends BaseEntity{
	use MagicAccessors;
	use Identifier;

	/**
	 * @var Service
	 * @ORM\ManyToOne(targetEntity="Service", inversedBy="id")
	 */
	private $idService;

	/**
	 * @var Provider
	 * @ORM\ManyToOne(targetEntity="Provider", inversedBy="id")
	 */
	private $idProivider;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetime")
	 */
	private $date;
}