<?php

use yii\db\Migration;

class m160705_004709_payed_column extends Migration
{
    public function up()
    {
        $this->addColumn('order_button', 'payed', 'boolean');
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
