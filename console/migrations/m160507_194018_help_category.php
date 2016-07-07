<?php

use yii\db\Migration;

class m160507_194018_help_category extends Migration
{
    public function up()
    {
        $this->createTable('help_category', [
            'id'=>$this->primaryKey(),
            'title' => $this->string(255),
        ]);

        return true;
    }

    public function down()
    {
        $this->dropTable('help_category');

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
