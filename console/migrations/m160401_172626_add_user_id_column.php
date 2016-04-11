<?php

use yii\db\Migration;

class m160401_172626_add_user_id_column extends Migration
{
    public function up()
    {
        $this->addColumn('codes', 'user_id', 'INT(11)');

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
