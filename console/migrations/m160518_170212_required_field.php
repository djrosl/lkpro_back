<?php

use yii\db\Migration;

class m160518_170212_required_field extends Migration
{
    public function up()
    {
        $this->addColumn('button_field', 'required', 'boolean');

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
