<?php

use yii\db\Migration;

class m160507_182010_help_table extends Migration
{
    public function up()
    {
        $this->createTable('help', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'text' => $this->text(),
            'is_main' => $this->boolean(),
            'category_id' => $this->integer(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime()
        ]);

        return true;
    }

    public function down()
    {
        $this->dropTable('help');

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
