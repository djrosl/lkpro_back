<?php

use yii\db\Migration;

class m160405_072950_add_name_column_to_database extends Migration
{
    public function up()
    {
        $this->addColumn('database', 'title', 'string');

        return true;
    }

    public function down()
    {

        return true;
    }
}
