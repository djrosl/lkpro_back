<?php

use yii\db\Migration;

class m160404_222537_db_id_field_to_buttons extends Migration
{
    public function up()
    {
        $this->addColumn('buttons', 'db_id', 'int');
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
