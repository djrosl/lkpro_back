<?php

use yii\db\Schema;
use yii\db\Migration;

class m160418_194534_create_order extends Migration
{
	public function up(){
		$this->createTable('order', [
			'id' => "MEDIUMINT(8)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'user_id' => "MEDIUMINT(8) UNSIGNED  NOT NULL",
			'base_type' => "MEDIUMINT(8) UNSIGNED  NOT NULL",
			'status' => "TINYINT(1) UNSIGNED  NOT NULL DEFAULT '1'",
			'cost' => "VARCHAR(255)  NOT NULL DEFAULT '0'",
		]);
		$this->createIndex('index_user_id_base_type_status_cost', 'order', ['user_id', 'base_type', 'status', 'cost']);
	}
	public function down(){
		$this->dropTable('order');
		return true;
	}
}