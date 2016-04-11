<?php

use yii\db\Schema;
use yii\db\Migration;

class m160402_205530_create_database extends Migration
{
	public function up(){
		$this->createTable('database', [
			'id' => "MEDIUMINT(8)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'content' => "TEXT  NOT NULL",
			'image' => "VARCHAR(255)  NOT NULL",
			'type_id' => "INT(11)  NOT NULL",
			'section_id' => "INT(11)  NOT NULL",
			'column_width' => "INT(11)  NOT NULL DEFAULT '0'",
			'type' => "INT(11)  NOT NULL DEFAULT '0'",
			'important' => "TEXT  DEFAULT NULL",
		]);
	}
	public function down(){
		$this->dropTable('database');
		return true;
	}
}