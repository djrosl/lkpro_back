<?php

use yii\db\Schema;
use yii\db\Migration;

class m160418_120459_create_field extends Migration
{
	public function up(){
		$this->createTable('field', [
			'id' => "MEDIUMINT(8)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'title' => "VARCHAR(255)  NOT NULL",
			'type' => "INT(11)  NOT NULL",
		]);
	}
	public function down(){
		$this->dropTable('field');
		return true;
	}
}