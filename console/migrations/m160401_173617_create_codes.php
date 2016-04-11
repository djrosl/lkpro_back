<?php

use yii\db\Schema;
use yii\db\Migration;

class m160401_173617_create_codes extends Migration
{
	public function up(){
		$this->createTable('codes', [
			'id' => "MEDIUMINT(8)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'code' => "VARCHAR(255)  NOT NULL",
			'used' => "BOOLEAN  NOT NULL DEFAULT '0'",
			'created_at' => "DATETIME(6)  DEFAULT NULL",
			'updated_at' => "DATETIME(6)  DEFAULT NULL",
		]);
	}
	public function down(){
		$this->dropTable('codes');
		return true;
	}
}