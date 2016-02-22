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
 * Class Service
 * @package App\Model\Entities
 * @ORM\Entity
 * @ORM\Table services
 */
class Service extends BaseEntity{
	use MagicAccessors;
	use Identifier;

	/**
	 * @var  string
	 * @ORM\Column(type="string")
	 */
	public $name;

	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	public $duration;

	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	public $description;
}