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
 * Class Provides
 * @package App\Model\Entities
 * @ORM\Entity
 * @ORM\Table providers
 */
class Provider extends BaseEntity{
	use MagicAccessors;
	use Identifier;

	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $name;

	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $address;
}