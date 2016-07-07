<?php

use yii\db\Schema;
use yii\db\Migration;

class m160418_194744_create_order_field extends Migration
{
	public function up(){
		$this->createTable('order_field', [
			'id' => "MEDIUMINT(8)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'order_id' => "MEDIUMINT(8) UNSIGNED  NOT NULL",
			'field_id' => "MEDIUMINT(8) UNSIGNED  NOT NULL",
			'content' => "TEXT  DEFAULT NULL",
		]);
		$this->createIndex('index_order_id_field_id', 'order_field', ['order_id', 'field_id']);
	}
	public function down(){
		$this->dropTable('order_field');
		return true;
	}
}