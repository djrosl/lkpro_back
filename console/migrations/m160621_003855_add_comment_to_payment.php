<?php

use yii\db\Migration;

class m160621_003855_add_comment_to_payment extends Migration
{
    public function up()
    {
        $this->addColumn('payment', 'comment', 'string');
    }

    public function down()
    {
        return true;
    }
}
