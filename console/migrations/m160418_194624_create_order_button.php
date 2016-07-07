<?php

use yii\db\Schema;
use yii\db\Migration;

class m160418_194624_create_order_button extends Migration
{
	public function up(){
		$this->createTable('order_button', [
			'id' => "MEDIUMINT(8)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'order_id' => "MEDIUMINT(8) UNSIGNED  NOT NULL",
			'button_id' => "MEDIUMINT(8) UNSIGNED  NOT NULL",
		]);
		$this->createIndex('index_order_id_button_id', 'order_button', ['order_id', 'button_id']);
	}
	public function down(){
		$this->dropTable('order_button');
		return true;
	}
}