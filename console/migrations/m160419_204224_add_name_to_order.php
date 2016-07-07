<?php

use yii\db\Migration;

class m160419_204224_add_name_to_order extends Migration
{
    public function up()
    {
        $this->addColumn('order', 'title', 'string');
    }

    public function down()
    {
        return true;
    }
}
