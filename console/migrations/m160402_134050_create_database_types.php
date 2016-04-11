<?php

use yii\db\Schema;
use yii\db\Migration;

class m160402_134050_create_database_types extends Migration
{
	public function up(){
		$this->createTable('database_types', [
			'id' => "MEDIUMINT(8)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'title' => "VARCHAR(255)  NOT NULL",
			'show_title' => "VARCHAR(255)  NOT NULL",
			'icon_class' => "VARCHAR(255)  NOT NULL DEFAULT 'archive'",
			'status' => "TINYINT(1) UNSIGNED  NOT NULL DEFAULT '1'",
			'created_at' => "DATETIME  DEFAULT NULL",
			'updated_at' => "DATETIME  DEFAULT NULL",
		]);
		$this->createIndex('index_status', 'database_types', ['status']);
	}
	public function down(){
		$this->dropTable('database_types');
		return true;
	}
}