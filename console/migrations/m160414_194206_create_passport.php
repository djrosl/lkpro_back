<?php

use yii\db\Schema;
use yii\db\Migration;

class m160414_194206_create_passport extends Migration
{
	public function up(){
		$this->createTable('passport', [
			'id' => "MEDIUMINT(8)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'user_id' => "MEDIUMINT(8)  NOT NULL",
			'own_lastname' => "VARCHAR(255)  NOT NULL",
			'own_firstname' => "VARCHAR(255)  NOT NULL",
			'own_fathername' => "VARCHAR(255)  NOT NULL",
			'own_maidenname' => "VARCHAR(255)  DEFAULT NULL",
			'own_birthplace' => "VARCHAR(255)  NOT NULL",
			'own_birthdate' => "DATE  NOT NULL",
			'pass_seria' => "VARCHAR(255)  NOT NULL",
			'pass_num' => "VARCHAR(255)  NOT NULL",
			'pass_get' => "DATE  NOT NULL",
			'pass_by' => "VARCHAR(255)  NOT NULL",
			'reg_region' => "VARCHAR(255)  NOT NULL",
			'reg_city' => "VARCHAR(255)  NOT NULL",
			'reg_street' => "VARCHAR(255)  NOT NULL",
			'reg_house' => "VARCHAR(255)  NOT NULL",
			'reg_housing' => "VARCHAR(255)  DEFAULT NULL",
			'reg_flat' => "VARCHAR(255)  NOT NULL",
		]);
	}
	public function down(){
		$this->dropTable('passport');
		return true;
	}
}