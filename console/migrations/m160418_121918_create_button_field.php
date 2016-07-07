<?php

use yii\db\Schema;
use yii\db\Migration;

class m160418_121918_create_button_field extends Migration
{
	public function up(){
		$this->createTable('button_field', [
			'id' => "MEDIUMINT(8)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'button_id' => "MEDIUMINT(8) UNSIGNED  NOT NULL",
			'field_id' => "MEDIUMINT(8) UNSIGNED  NOT NULL",
		]);
		$this->createIndex('index_button_id_field_id', 'button_field', ['button_id', 'field_id']);
	}
	public function down(){
		$this->dropTable('button_field');
		return true;
	}
}