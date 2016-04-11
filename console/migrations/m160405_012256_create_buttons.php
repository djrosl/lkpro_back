<?php

use yii\db\Schema;
use yii\db\Migration;

class m160405_012256_create_buttons extends Migration
{
	public function up(){
		$this->createTable('buttons', [
			'id' => "MEDIUMINT(8)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'title' => "VARCHAR(255)  NOT NULL",
			'price' => "INT(11)  NOT NULL",
			'help' => "TEXT  DEFAULT NULL",
			'example' => "TEXT  DEFAULT NULL",
			'time' => "TEXT  DEFAULT NULL",
			'status' => "BOOLEAN  NOT NULL DEFAULT '1'",
		]);
	}
	public function down(){
		$this->dropTable('buttons');
		return true;
	}
}