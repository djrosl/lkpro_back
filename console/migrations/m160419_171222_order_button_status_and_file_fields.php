<?php

use yii\db\Migration;

class m160419_171222_order_button_status_and_file_fields extends Migration
{
    public function up()
    {
        $this->addColumn('order_button', 'status', 'int');
        $this->addColumn('order_button', 'file', 'string');

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
