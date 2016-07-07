<?php

use yii\db\Migration;

class m160620_135624_cashtype extends Migration
{
    public function up()
    {

        $this->createTable('cash_type', [
            'id'=>$this->primaryKey(),
            'icon'=>$this->string(255),
            'title'=>$this->string(255),
            'number'=>$this->string(255)
        ]);

    }

    public function down()
    {
        

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
