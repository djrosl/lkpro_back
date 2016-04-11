<?php

use yii\db\Schema;
use yii\db\Migration;

class m160402_185538_create_type_sections extends Migration
{
	public function up(){
		$this->createTable('type_sections', [
			'id' => "MEDIUMINT(8)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'title' => "VARCHAR(255)  NOT NULL",
			'info' => "TEXT  DEFAULT NULL",
			'order' => "MEDIUMINT(8) UNSIGNED  NOT NULL DEFAULT '1'",
			'type_id' => "MEDIUMINT(8) UNSIGNED  NOT NULL",
		]);
		$this->createIndex('index_order_type_id', 'type_sections', ['order', 'type_id']);
	}
	public function down(){
		$this->dropTable('type_sections');
		return true;
	}
}