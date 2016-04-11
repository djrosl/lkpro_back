<?php

namespace common\behaviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class Codegen extends Behavior
{
	public $out_attribute = 'code';

	public function getCode( $event ){
		$this->owner->{$this->out_attribute} = $this->generateCode();
	}

	private function generateCode(){
		return substr(md5(rand()), 0, 32);
	}

	public function events()
	{
		return [
			ActiveRecord::EVENT_AFTER_VALIDATE => 'getCode'
		];
	}	
}