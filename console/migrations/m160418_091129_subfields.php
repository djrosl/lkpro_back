<?php

use yii\db\Migration;

class m160418_091129_subfields extends Migration
{
    public function up()
    {
        $this->addColumn('field', 'subfields', 'text');
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
