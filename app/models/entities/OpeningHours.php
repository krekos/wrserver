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
 * Class OpeningHours
 * @package App\Model\Entities
 * @ORM\Entity
 * @ORM\Table opening_hours
 */
class OpeningHours extends BaseEntity{
	use MagicAccessors;
	use Identifier;

	/**
	 * @var Queue
	 * @ORM\ManyToOne(targetEntity="Queue", inversedBy="id")
	 */
	private $idQueue;

	/**
	 * @var string
	 * @ORM\Column(type="string", nullable=true)
	 */
	private $day;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="date")
	 */
	private $start;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="date")
	 */
	private $end;
}