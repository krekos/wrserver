<?php
/**
 * @author Radim Křek
 * Date: 08.02.2016
 */

namespace App\Model\Entities;


use Nette\Object;

class BaseEntity extends Object{

	public function __construct($data = null){
		if($data && method_exists($this, 'toEntity')){
			$this->toEntity($data);
		}
	}

	public function toArray(){
		$ret = array();
		$ret['id'] = $this->getId();
		$vars = get_object_vars($this);
		foreach(get_object_vars($this) as $key => $val){
			if($val instanceof BaseEntity){
				$val = $val->toArray();
			}
			$ret[$key] = $val;
		}
		return $ret;
	}
}