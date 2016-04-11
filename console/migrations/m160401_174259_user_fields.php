<?php

use yii\db\Migration;

class m160401_174259_user_fields extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'jabber', 'string');
        $this->addColumn('{{%user}}', 'icq', 'string');

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
