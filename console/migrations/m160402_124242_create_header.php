<?php

use yii\db\Schema;
use yii\db\Migration;

class m160402_124242_create_header extends Migration
{
	public function up(){
		$this->createTable('header', [
			'id' => "MEDIUMINT(8)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'column_1' => "VARCHAR(255)  NOT NULL",
			'column_2' => "VARCHAR(255)  NOT NULL",
			'column_3' => "VARCHAR(255)  NOT NULL",
		]);
	}
	public function down(){
		$this->dropTable('header');
		return true;
	}
}