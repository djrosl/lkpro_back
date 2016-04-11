<?php

use yii\db\Migration;

class m160402_114435_add_slug_to_types extends Migration
{
    public function up()
    {
        $this->addColumn('database_types','slug', 'string not null');

        return true;
    }

    public function down()
    {
        return true;
    }
}
