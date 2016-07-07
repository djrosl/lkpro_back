<?php

use yii\db\Migration;

class m160518_201358_order_button_tooltip extends Migration
{
    public function up()
    {

        $this->addColumn('order_button', 'tooltip', 'string');

        return true;
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
